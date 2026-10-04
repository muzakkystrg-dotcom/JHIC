<?php

namespace App\Jobs;

use App\Models\Applicant;
use App\Models\Industry;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Sebar satu lamaran alumni (Hirelink) ke dashboard SELURUH mitra industri.
 *
 * Sebelumnya fan-out ini dikerjakan SINKRON di dalam request
 * `CareerCenterController::submitRegistration` sehingga user menunggu
 * ~N query (N = jumlah mitra) + proses tulis selesai sebelum redirect.
 * Sekarang dikerjakan di background queue:
 *   - request submit menjadi O(1) (langsung redirect),
 *   - jumlah round-trip DB dipangkas (1 query student, 1 query job posting,
 *     1 batch upsert) alih-alih query per-mitra.
 *
 * Catatan idempotensi: job ini aman di-retry. Titik serialisasi data
 * dijaga oleh unique index `(industry_id, job_application_id)` +
 * `Applicant::upsert()` (bukan updateOrCreate yang balapan), dan `status`
 * sengaja TIDAK ditimpa saat baris sudah ada agar keputusan mitra
 * (terima/wawancara/tolak) tidak ter-reset oleh retry.
 */
class ProcessApplicantFanOut implements ShouldQueue
{
    use Queueable;

    /**
     * Batas percobaan. Job ini idempoten, jadi retry aman.
     */
    public int $tries = 3;

    /**
     * @param  int  $jobApplicationId  ID lamaran (dikirim sebagai skalar, bukan model)
     */
    public function __construct(
        public readonly int $jobApplicationId,
    ) {}

    public function handle(): void
    {
        $application = JobApplication::query()->find($this->jobApplicationId);

        // Lamaran bisa saja sudah dihapus antara dispatch dan eksekusi.
        if ($application === null) {
            return;
        }

        $industries = Industry::query()->get(['id']);

        if ($industries->isEmpty()) {
            return;
        }

        $skills = is_array($application->skills) ? array_values(array_filter($application->skills)) : [];
        $encodedSkills = json_encode($skills, JSON_UNESCAPED_UNICODE);

        // Ambil data siswa SEKALI (sebelumnya resolveMajor + resolveDtp
        // masing-masing menembak query `students` -> 2x query per mitra).
        $student = $application->sso
            ? Student::query()->where('sso', trim($application->sso))->first()
            : null;

        $major = $student->major ?? 'Siswa SMK Telkom Sidoarjo';
        $dtp = $student->dtp ?? '2023/2024';

        // Satu query untuk mencari job posting aktif per mitra
        // (sebelumnya JobPosting::...->first() dipanggil di dalam loop -> N query).
        $jobPostingIds = JobPosting::query()
            ->whereIn('industry_id', $industries->pluck('id'))
            ->orderByDesc('is_active')
            ->get(['id', 'industry_id'])
            ->unique('industry_id')
            ->pluck('id', 'industry_id');

        $now = now();
        $score = $this->estimateMatchScore($skills);

        $rows = $industries->map(fn (Industry $industry) => [
            'industry_id' => $industry->id,
            'job_application_id' => $application->id,
            'job_posting_id' => $jobPostingIds->get($industry->id),
            'source' => 'hirelink',
            'sso_number' => $application->sso ?? '',
            'full_name' => $application->full_name,
            'major' => $major,
            'dtp' => $dtp,
            'email' => $application->email,
            'phone' => $application->phone,
            'linkedin_url' => $application->linkedin,
            'skills' => $encodedSkills,
            'ai_match_score' => $score,
            'work_preference' => $application->work_preference ?: 'On-Site',
            'status' => 'pending',
            'created_at' => $now,
            'updated_at' => $now,
        ])->all();

        DB::transaction(function () use ($rows) {
            try {
                // Batch insert/update dalam satu statement.
                // Kolom `status` sengaja tidak ikut di-update ulang.
                Applicant::query()->upsert(
                    $rows,
                    ['industry_id', 'job_application_id'],
                    [
                        'job_posting_id', 'source', 'sso_number', 'full_name',
                        'major', 'dtp', 'email', 'phone', 'linkedin_url',
                        'skills', 'ai_match_score', 'work_preference', 'updated_at',
                    ],
                );
            } catch (QueryException $e) {
                // Jalur aman untuk instalasi yang BELUM menjalankan migrasi
                // unique index `(industry_id, job_application_id)`: MySQL/MariaDB
                // menolak upsert tanpa unique index. Fallback ke updateOrCreate
                // (perilaku lama) supaya job tetap berjalan.
                Log::warning('[FanOut] upsert gagal, fallback updateOrCreate: '.$e->getMessage());
                $this->persistOneByOne($rows);
            }
        });
    }

    /**
     * Fallback lama: satu baris per mitra. Hanya dipakai bila upsert tidak
     * tersedia (unique index belum ada).
     *
     * @param  array<int, array<string, mixed>>  $rows
     */
    private function persistOneByOne(array $rows): void
    {
        foreach ($rows as $row) {
            Applicant::query()->updateOrCreate(
                [
                    'industry_id' => $row['industry_id'],
                    'job_application_id' => $row['job_application_id'],
                ],
                $row,
            );
        }
    }

    /**
     * Skor kecocokan awal dari jumlah hard skill yang dipilih (50-95).
     *
     * @param  array<int, mixed>  $skills
     */
    private function estimateMatchScore(array $skills): int
    {
        return min(50 + (count($skills) * 8), 95);
    }
}
