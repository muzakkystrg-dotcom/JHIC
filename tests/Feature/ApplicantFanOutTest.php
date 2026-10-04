<?php

namespace Tests\Feature;

use App\Jobs\ProcessApplicantFanOut;
use App\Models\Applicant;
use App\Models\Industry;
use App\Models\JobApplication;
use Database\Seeders\IndustrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ApplicantFanOutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Submit form lamaran harus LANGSUNG redirect (tidak menunggu fan-out),
     * dan fan-out-nya dikirim ke queue.
     */
    public function test_registration_dispatches_fanout_job_and_redirects(): void
    {
        Queue::fake();

        $response = $this->post(route('career-center.register.submit'), [
            'full_name' => 'Alumni Test',
            'email' => 'alumni.test@example.com',
            'phone' => '081234567890',
            'skills' => ['Laravel', 'Docker'],
            'work_preference' => 'On-Site',
        ]);

        $response->assertRedirect(route('career-center.success'));

        Queue::assertPushed(ProcessApplicantFanOut::class);
    }

    /**
     * Job fan-out membuat SATU baris pelamar per mitra industri,
     * menyimpan skills sebagai array (cast), dan menghitung skor.
     */
    public function test_fanout_job_creates_one_applicant_per_industry(): void
    {
        $this->seed(IndustrySeeder::class);

        $application = JobApplication::query()->create([
            'sso' => 'TEST-001',
            'full_name' => 'Pelamar Fan Out',
            'email' => 'fanout@example.com',
            'phone' => '0800000000',
            'skills' => ['Laravel', 'Vue', 'Docker'],
            'work_preference' => 'On-Site',
        ]);

        (new ProcessApplicantFanOut($application->id))->handle();

        $industryCount = Industry::query()->count();
        $rows = Applicant::query()->where('job_application_id', $application->id)->get();

        $this->assertSame($industryCount, $rows->count());
        $this->assertSame(['Laravel', 'Vue', 'Docker'], $rows->first()->skills);
        $this->assertSame(74, $rows->first()->ai_match_score); // 50 + 3*8
        $this->assertSame('pending', $rows->first()->status);
        $this->assertSame('hirelink', $rows->first()->source);
    }

    /**
     * Retry job tidak boleh menggandakan baris (idempoten).
     */
    public function test_fanout_job_is_idempotent_on_retry(): void
    {
        $this->seed(IndustrySeeder::class);

        $application = JobApplication::query()->create([
            'sso' => 'TEST-002',
            'full_name' => 'Pelamar Retry',
            'email' => 'retry@example.com',
            'phone' => '0800000001',
            'skills' => ['Laravel'],
            'work_preference' => 'Remote',
        ]);

        (new ProcessApplicantFanOut($application->id))->handle();
        (new ProcessApplicantFanOut($application->id))->handle();

        $this->assertSame(
            Industry::query()->count(),
            Applicant::query()->where('job_application_id', $application->id)->count(),
        );
    }

    /**
     * Retry job TIDAK boleh mereset keputusan mitra (status) yang sudah final.
     */
    public function test_fanout_job_does_not_reset_industry_status(): void
    {
        $this->seed(IndustrySeeder::class);

        $application = JobApplication::query()->create([
            'sso' => 'TEST-003',
            'full_name' => 'Pelamar Status',
            'email' => 'status@example.com',
            'phone' => '0800000002',
            'skills' => ['Laravel'],
            'work_preference' => 'On-Site',
        ]);

        (new ProcessApplicantFanOut($application->id))->handle();

        Applicant::query()
            ->where('job_application_id', $application->id)
            ->first()
            ->update(['status' => 'accepted']);

        (new ProcessApplicantFanOut($application->id))->handle();

        $this->assertSame(
            'accepted',
            Applicant::query()
                ->where('job_application_id', $application->id)
                ->orderBy('id')
                ->value('status'),
        );
    }
}
