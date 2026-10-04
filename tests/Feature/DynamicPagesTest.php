<?php

namespace Tests\Feature;

use App\Models\Alumni;
use App\Models\PenerapanK3;
use App\Models\Prestasi;
use App\Models\TrialClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DynamicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_alumni_page_lists_seeded_data(): void
    {
        $this->get('/informasi/alumni')
            ->assertOk()
            ->assertSee('Ahmad Fauzi')
            ->assertSee('541211001');
    }

    public function test_alumni_search_filters_by_sso(): void
    {
        $response = $this->get('/informasi/alumni?search=541211002');

        $response->assertOk()
            ->assertSee('Siti Aminah')
            ->assertDontSee('Ahmad Fauzi');
    }

    public function test_prestasi_page_lists_seeded_data_and_chart(): void
    {
        $response = $this->get('/tentang-kami/prestasi');

        $response->assertOk()
            ->assertSee('Juara 1 LKS Web Technologies Tingkat Nasional')
            ->assertSee('chartData');
    }

    public function test_penerapan_k3_page_lists_documents(): void
    {
        $this->get('/informasi/penerapan-k3')
            ->assertOk()
            ->assertSee('SOP Keselamatan Praktikum Lab Komputer')
            ->assertSee('12 Januari 2025');
    }

    public function test_trial_class_page_lists_sessions(): void
    {
        $this->get('/informasi/trial-class')
            ->assertOk()
            ->assertSee('Eksplorasi Jaringan Fiber Optik')
            ->assertSee('25 Siswa');
    }

    public function test_trial_class_search_filters_by_jurusan(): void
    {
        $response = $this->get('/informasi/trial-class?search=IoT');

        $response->assertOk()
            ->assertSee('Smart Home Automation')
            ->assertDontSee('Eksplorasi Jaringan Fiber Optik');
    }

    public function test_models_generate_unique_slugs(): void
    {
        $alumni = Alumni::first();
        $this->assertNotEmpty($alumni->slug);
        $this->assertSame($alumni->id, Alumni::where('slug', $alumni->slug)->value('id'));

        $this->assertNotEmpty(Prestasi::first()->slug);
        $this->assertNotEmpty(PenerapanK3::first()->slug);
        $this->assertNotEmpty(TrialClass::first()->slug);
    }
}
