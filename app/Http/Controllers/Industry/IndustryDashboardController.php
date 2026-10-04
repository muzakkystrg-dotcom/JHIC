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

        $baseApplicants = Applicant::query()->where('industry_id', $industry->id);

        $metrics = [
            // Kandidat baru yang belum ditindak (status: pending).
            'kandidat_baru' => (clone $baseApplicants)->where('status', 'pending')->count(),
            // Kandidat yang diterima pada minggu berjalan.
            'diterima_minggu_ini' => (clone $baseApplicants)
                ->where('status', 'accepted')
                ->where('updated_at', '>=', now()->startOfWeek())
                ->count(),
            // Total kandidat yang masuk ke perusahaan ini.
            'total_kandidat' => (clone $baseApplicants)->count(),
        ];

        $activeJobs = JobPosting::query()
            ->where('industry_id', $industry->id)
            ->where('is_active', true)
            ->withCount('applicants')
            ->latest()
            ->get();

        $inactiveJobs = JobPosting::query()
            ->where('industry_id', $industry->id)
            ->where('is_active', false)
            ->withCount('applicants')
            ->latest()
            ->get();

        return view('pages.industry.dashboard.index', compact('industry', 'metrics', 'activeJobs', 'inactiveJobs'));
    }
}
