<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Industry;
use App\Models\JobPosting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndustrySeeder extends Seeder
{
    /**
     * Password default seluruh akun mitra demo (WAJIB diganti di produksi).
     */
    private const DEMO_PASSWORD = 'password123';

    /**
     * ID login khusus yang harus dipertahankan (dipakai untuk login demo).
     *
     * @var array<string, string>
     */
    private const INDUSTRY_ID_OVERRIDES = [
        'pt-garuda-telekomunikasi-indonesia' => 'IND-GARUDA-01',
    ];

    /**
     * Seed mitra industri + lowongan + pelamar contoh.
     *
     * Daftar mitra diambil dari config/mitra.php supaya konsisten dengan halaman
     * publik (career center, hubungan industri) yang sudah ada.
     */
    public function run(): void
    {
        /** @var array<string, Industry> $industries */
        $industries = [];

        foreach (config('mitra', []) as $slug => $mitra) {
            $industry = Industry::firstOrNew(['slug' => $slug]);

            if (! $industry->exists) {
                $industry->industry_id = self::INDUSTRY_ID_OVERRIDES[$slug]
                    ?? 'IND-'.Str::upper(Str::slug($slug, '-'));
                $industry->password = Hash::make(self::DEMO_PASSWORD);
            }

            $industry->company_name = $this->normalizeCompanyName($mitra['nama'] ?? $slug);
            $industry->logo = $mitra['logo'] ?? $industry->logo;
            $industry->address = $mitra['alamat'] ?? $industry->address;
            $industry->email = $industry->email ?: $slug.'@industri.skomda.sch.id';
            $industry->save();

            $industries[$slug] = $industry;
        }

        // Lowongan contoh untuk mitra utama (dipakai tombol "Cari Talent Pool Baru").
        $garuda = $industries['pt-garuda-telekomunikasi-indonesia'] ?? null;

        if ($garuda) {
            JobPosting::updateOrCreate(
                ['industry_id' => $garuda->id, 'title' => 'Junior DevOps'],
                [
                    'category' => 'Full Time',
                    'location' => 'Surabaya, Indonesia',
                    'is_active' => true,
                ],
            );
        }

        // Pelamar contoh. SSO, nama, dan jurusan disamakan dengan tabel `students`
        // (sumber data verifikasi SSO) supaya tidak ada identitas yang bentrok.
        $demoApplicants = [
            [
                'sso_number' => '541211001',
                'full_name' => 'Ahmad Fauzi',
                'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
                'dtp' => '2023/2024',
                'email' => 'ahmad.fauzi@student.telkomsda.sch.id',
                'phone' => '081234567890',
                'linkedin_url' => 'https://linkedin.com/in/ahmadfauzi',
                'skills' => ['Web Development', 'Docker', 'Linux', 'Laravel'],
                'ai_match_score' => 96,
                'work_preference' => 'On-Site',
                'status' => 'pending',
                'interview_details' => null,
            ],
            [
                'sso_number' => '541211002',
                'full_name' => 'Siti Aminah',
                'major' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
                'dtp' => '2023/2024',
                'email' => 'siti.aminah@student.telkomsda.sch.id',
                'phone' => '085678901234',
                'linkedin_url' => 'https://linkedin.com/in/sitiaminah',
                'skills' => ['Fiber Optic', 'Cisco', 'MikroTik'],
                'ai_match_score' => 89,
                'work_preference' => 'Hybrid',
                'status' => 'interview',
                'interview_details' => 'Senin, 10:00 WIB via Google Meet',
            ],
        ];

        if ($garuda) {
            $job = JobPosting::where('industry_id', $garuda->id)->first();

            foreach ($demoApplicants as $data) {
                Applicant::updateOrCreate(
                    [
                        'industry_id' => $garuda->id,
                        'sso_number' => $data['sso_number'],
                    ],
                    $data + [
                        'job_posting_id' => $job?->id,
                        'source' => 'seed',
                    ],
                );
            }
        }
    }

    /**
     * Rapikan penulisan nama perusahaan ("Pt." / "PT." -> "PT").
     */
    private function normalizeCompanyName(string $name): string
    {
        $name = preg_replace('/\bP[tT]\./u', 'PT', $name);

        return trim((string) $name);
    }
}
