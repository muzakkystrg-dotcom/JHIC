<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustryJobController extends Controller
{
    /**
     * Daftar lowongan (talent pool) milik mitra yang sedang login.
     */
    public function index(Request $request)
    {
        $industry = Auth::guard('industry')->user();

        $query = JobPosting::query()
            ->where('industry_id', $industry->id)
            ->withCount('applicants');

        if ($request->filled('skill')) {
            $skill = $request->input('skill');
            $query->where('title', 'like', "%{$skill}%");
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === 'buka');
        }

        $jobs = $query->latest()->get();

        return view('pages.industry.dashboard.jobs', compact('industry', 'jobs'));
    }

    /**
     * Buat talent pool / lowongan baru.
     */
    public function store(Request $request)
    {
        $industry = Auth::guard('industry')->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        JobPosting::create([
            'industry_id' => $industry->id,
            'title' => $validated['title'],
            'category' => $validated['category'],
            'location' => $validated['location'],
            'is_active' => true,
        ]);

        return back()->with('success', 'Lowongan baru berhasil ditambahkan.');
    }

    /**
     * Hapus lowongan milik mitra.
     */
    public function destroy($id)
    {
        $industry = Auth::guard('industry')->user();

        $job = JobPosting::query()
            ->where('industry_id', $industry->id)
            ->findOrFail($id);

        $job->delete();

        return back()->with('success', 'Lowongan berhasil dihapus.');
    }
}
