<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndustryApplicantController extends Controller
{
    /**
     * Daftar pelamar/kandidat untuk mitra yang sedang login.
     */
    public function index(Request $request)
    {
        $industry = Auth::guard('industry')->user();

        $applicants = Applicant::query()
            ->where('industry_id', $industry->id)
            ->with('jobPosting')
            ->orderByDesc('ai_match_score')
            ->get();

        return view('pages.industry.dashboard.applicants', compact('industry', 'applicants'));
    }

    /**
     * Detail satu pelamar. Hanya boleh dibuka oleh mitra pemilik lamaran
     * (kalau bukan miliknya -> 404, tidak menampilkan data contoh/placeholder).
     */
    public function show($id)
    {
        $industry = Auth::guard('industry')->user();

        $applicant = Applicant::query()
            ->where('industry_id', $industry->id)
            ->with(['jobPosting', 'jobApplication'])
            ->findOrFail($id);

        return view('pages.industry.dashboard.applicant-detail', compact('industry', 'applicant'));
    }

    /**
     * Ubah status pelamar (terima / undang wawancara / tolak).
     */
    public function updateStatus(Request $request, $id)
    {
        $industry = Auth::guard('industry')->user();

        $applicant = Applicant::query()
            ->where('industry_id', $industry->id)
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:accepted,interview,rejected,pending',
        ]);

        $applicant->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    /**
     * Unduh berkas pelamar (CV / portofolio) dari disk privat.
     *
     * Berkas disimpan di disk 'local' (storage/app/private) supaya tidak bisa
     * diakses publik; mitra hanya boleh mengunduh milik pelamarnya sendiri.
     */
    public function downloadFile($id, string $type)
    {
        $industry = Auth::guard('industry')->user();

        $applicant = Applicant::query()
            ->where('industry_id', $industry->id)
            ->with('jobApplication')
            ->findOrFail($id);

        $application = $applicant->jobApplication;

        abort_unless($application, 404);

        $path = $type === 'portfolio'
            ? $application->portfolio_path
            : $application->resume_path;

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        $label = $type === 'portfolio' ? 'Portfolio' : 'CV';
        $extension = pathinfo($path, PATHINFO_EXTENSION) ?: 'pdf';

        return Storage::disk('local')->download(
            $path,
            Str::slug($applicant->full_name).'-'.$label.'.'.$extension,
        );
    }
}
