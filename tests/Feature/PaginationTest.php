<?php

namespace Tests\Feature;

use App\Models\Alumni;
use App\Models\Applicant;
use App\Models\Berita;
use App\Models\Industry;
use App\Models\JobPosting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Halaman alumni memakai paginator (view menerima LengthAwarePaginator),
     * dengan `perPage` 15.
     */
    public function test_alumni_page_uses_paginator(): void
    {
        $this->seed();

        $response = $this->get('/informasi/alumni');

        $response->assertOk();
        $alumnis = $response->viewData('alumnis');

        $this->assertInstanceOf(LengthAwarePaginator::class, $alumnis);
        $this->assertSame(15, $alumnis->perPage());
        // 5 baris seed → 1 halaman
        $this->assertSame(1, $alumnis->lastPage());
    }

    /**
     * Halaman berita dipaginasi 9 per halaman dan tetap memuat kategori.
     */
    public function test_berita_page_paginates_nine_per_page(): void
    {
        $this->seed();

        $response = $this->get('/informasi/berita');

        $response->assertOk();
        $beritas = $response->viewData('beritas');

        $this->assertSame(9, $beritas->perPage());
        $this->assertGreaterThanOrEqual(1, $beritas->lastPage());
        $this->assertNotEmpty($response->viewData('categories'));
    }

    /**
     * Daftar pelamar mitra hanya menampilkan milik mitra tsb, dipaginasi 20,
     * dan mengeager-load jobPosting (tanpa N+1).
     */
    public function test_industry_applicants_paginated_and_scoped(): void
    {
        // Buat mitra sendiri (tidak bergantung penugasan pelamar di seeder).
        $me = Industry::query()->create([
            'industry_id' => 'T-ME-01', 'company_name' => 'Mitra Me', 'password' => bcrypt('x'),
        ]);
        $other = Industry::query()->create([
            'industry_id' => 'T-OT-01', 'company_name' => 'Mitra Other', 'password' => bcrypt('x'),
        ]);

        // 25 pelamar untuk mitra login → 2 halaman (perPage 20)
        for ($i = 0; $i < 25; $i++) {
            Applicant::query()->create([
                'industry_id' => $me->id,
                'sso_number' => 'P-'.$i,
                'full_name' => 'Pelamar '.$i,
                'major' => 'SIJA',
                'dtp' => '2023/2024',
                'email' => "p{$i}@example.test",
                'phone' => '0800',
                'skills' => ['x'],
                'ai_match_score' => 50 + $i,
                'work_preference' => 'On-Site',
                'status' => 'pending',
            ]);
        }

        // pelamar milik mitra LAIN, tidak boleh muncul
        Applicant::query()->create([
            'industry_id' => $other->id,
            'sso_number' => 'OTHER',
            'full_name' => 'Punya Mitra Lain',
            'major' => 'TJAT',
            'dtp' => '2023/2024',
            'email' => 'other@example.test',
            'phone' => '0800',
            'skills' => ['y'],
            'ai_match_score' => 99,
            'work_preference' => 'On-Site',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($me, 'industry')->get(route('industry.applicants.index'));

        $response->assertOk();
        $response->assertDontSee('Punya Mitra Lain');

        $applicants = $response->viewData('applicants');
        $this->assertSame(20, $applicants->perPage());
        $this->assertSame(25, $applicants->total());
        $this->assertSame(2, $applicants->lastPage());
        // eager loaded
        $this->assertTrue($applicants->first()->relationLoaded('jobPosting'));
    }

    /**
     * Dashboard mitra tetap menampilkan angka benar setelah query dipadatkan.
     */
    public function test_industry_dashboard_metrics_and_job_split(): void
    {
        $me = Industry::query()->create([
            'industry_id' => 'T-DASH-01', 'company_name' => 'Mitra Dashboard', 'password' => bcrypt('x'),
        ]);

        Applicant::query()->create([
            'industry_id' => $me->id, 'sso_number' => 'A1', 'full_name' => 'A',
            'major' => 'SIJA', 'dtp' => '2023/2024', 'email' => 'a@example.test',
            'phone' => '0800', 'skills' => ['x'], 'ai_match_score' => 60,
            'work_preference' => 'On-Site', 'status' => 'pending',
        ]);
        Applicant::query()->create([
            'industry_id' => $me->id, 'sso_number' => 'A2', 'full_name' => 'B',
            'major' => 'SIJA', 'dtp' => '2023/2024', 'email' => 'b@example.test',
            'phone' => '0800', 'skills' => ['x'], 'ai_match_score' => 61,
            'work_preference' => 'On-Site', 'status' => 'accepted',
        ]);

        JobPosting::query()->create(['industry_id' => $me->id, 'title' => 'Aktif', 'category' => 'x', 'location' => 'Sidoarjo', 'is_active' => true]);
        JobPosting::query()->create(['industry_id' => $me->id, 'title' => 'Tutup', 'category' => 'x', 'location' => 'Sidoarjo', 'is_active' => false]);

        $response = $this->actingAs($me, 'industry')->get(route('industry.dashboard'));

        $response->assertOk();
        $metrics = $response->viewData('metrics');

        $this->assertSame(2, $metrics['total_kandidat']);
        $this->assertSame(1, $metrics['kandidat_baru']);
        $this->assertSame(1, $metrics['diterima_minggu_ini']);

        $this->assertSame(1, $response->viewData('activeJobs')->count());
        $this->assertSame('Aktif', $response->viewData('activeJobs')->first()->title);
        $this->assertSame(1, $response->viewData('inactiveJobs')->count());
        $this->assertSame('Tutup', $response->viewData('inactiveJobs')->first()->title);
    }
}
