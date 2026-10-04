<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;

class IndustryDashboardController extends Controller
{
    /**
     * Halaman utama portal mitra industri.
     *
     * Semua angka & daftar lowongan diambil dari database untuk mitra yang
     * sedang login (guard: industry) -- tidak ada data contoh/hardcode.
     */
    public function index()
    {
        $industry = Auth::guard('industry')->user();

        // PADAT: satu query agregat menggantikan 3x count() terpisah.
        // SUM(CASE WHEN ...) dihitung oleh DB dalam satu kali jalan.
        $row = Applicant::query()
            ->where('industry_id', $industry->id)
            ->selectRaw('COUNT(*) as total_kandidat')
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as kandidat_baru', ['pending'])
            ->selectRaw(
                'SUM(CASE WHEN status = ? AND updated_at >= ? THEN 1 ELSE 0 END) as diterima_minggu_ini',
                ['accepted', now()->startOfWeek()],
            )
            ->first();

        $metrics = [
            'kandidat_baru' => (int) ($row->kandidat_baru ?? 0),
            'diterima_minggu_ini' => (int) ($row->diterima_minggu_ini ?? 0),
            'total_kandidat' => (int) ($row->total_kandidat ?? 0),
        ];

        // Satu query untuk semua lowongan mitra; dipisah di memori supaya
        // tidak perlu 2x query (aktif / ditutup).
        $jobs = JobPosting::query()
            ->where('industry_id', $industry->id)
            ->withCount('applicants')
            ->latest()
            ->get();

        $activeJobs = $jobs->filter(fn ($job) => (bool) $job->is_active)->values();
        $inactiveJobs = $jobs->reject(fn ($job) => (bool) $job->is_active)->values();

        return view('pages.industry.dashboard.index', compact('industry', 'metrics', 'activeJobs', 'inactiveJobs'));
    }
}
