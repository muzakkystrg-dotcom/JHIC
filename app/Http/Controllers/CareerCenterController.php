<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CareerCenterController extends Controller
{
    /**
     * Menampilkan Halaman Utama Career Center
     */
    public function index()
    {
        // Lowongan diambil dari tabel `job_vacancies` (hanya yang aktif).
        $lowongans = JobVacancy::query()
            ->where('is_active', true)
            ->orderByDesc('posted_at')
            ->get();

        return view('pages.career-center', compact('lowongans'));
    }

    /**
     * Menampilkan Halaman Verifikasi SSO
     */
    public function ssoForm()
    {
        return view('pages.sso-form');
    }

    /**
     * Verifikasi SSO siswa.
     *
     * Sumber data: tabel `students` (diisi via StudentSeeder / data resmi sekolah).
     * Ganti/populate tabel tersebut dengan data SSO resmi saat tersedia.
     *
     * AJAX Check SSO Siswa (fail-closed).
     *
     * Sukses HANYA diberikan saat SSO ditemukan di sumber data.
     * Validasi gagal => 422, SSO tidak ditemukan => 404, error tak terduga => 503.
     * Jangan pernah mengembalikan status sukses ketika terjadi error/gagal.
     */
    public function checkSso(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sso' => ['required', 'string', 'max:50'],
        ]);

        try {
            $student = $this->findStudentBySso($validated['sso']);
        } catch (\Throwable $e) {
            Log::error('[SSO] Verifikasi gagal: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Verifikasi SSO sedang tidak tersedia. Coba lagi beberapa saat lagi.',
            ], 503);
        }

        if ($student === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'SSO tidak valid atau tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa terverifikasi',
            'data' => $student,
        ]);
    }

    /**
     * Cari siswa berdasarkan nomor SSO di tabel `students`.
     *
     * @return array{sso:string,name:string,major:string,dtp:string}|null
     */
    private function findStudentBySso(string $sso): ?array
    {
        $student = Student::query()
            ->where('sso', trim($sso))
            ->first();

        if ($student === null) {
            return null;
        }

        return [
            'sso' => $student->sso,
            'name' => $student->name,
            'major' => $student->major,
            'dtp' => $student->dtp,
        ];
    }

    /**
     * Menampilkan Form Requirement / Pendaftaran
     */
    public function registerForm(Request $request)
    {
        $sso = $request->query('sso');
        $isSuccess = false;

        return view('pages.form-requirement', compact('sso', 'isSuccess'));
    }

    /**
     * Memproses Submit Form dan Mengarahkan ke Halaman Sukses
     */
    public function submitRegistration(Request $request)
    {
        $validated = $request->validate([
            'sso' => 'nullable|string|max:50',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'linkedin' => 'nullable|url|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'portfolio' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
            'job_interest' => 'nullable|string|max:255',
            'work_preference' => 'nullable|in:Remote,On-Site,Hybrid',
            'start_date' => 'nullable|date',
        ]);

        // Simpan berkas ke disk privat (storage/app/private/{resume|portfolio}).
        // Jangan pakai disk 'public': berkas berisi PII tanpa akses terkontrol.
        $resumePath = $request->hasFile('resume')
            ? $request->file('resume')->store('resume', 'local')
            : null;

        $portfolioPath = $request->hasFile('portfolio')
            ? $request->file('portfolio')->store('portfolio', 'local')
            : null;

        JobApplication::create([
            'sso' => $validated['sso'] ?? null,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'linkedin' => $validated['linkedin'] ?? null,
            'resume_path' => $resumePath,
            'portfolio_path' => $portfolioPath,
            'skills' => $validated['skills'] ?? [],
            'job_interest' => $validated['job_interest'] ?? null,
            'work_preference' => $validated['work_preference'] ?? 'On-Site',
            'start_date' => $validated['start_date'] ?? null,
        ]);

        // Redirect langsung ke route sukses
        return redirect()->route('career-center.success');
    }

    /**
     * Menampilkan Tampilan Sukses "Apply Karier Mu Berhasil!" (Figma Desktop 3)
     */
    public function applySuccess()
    {
        $sso = null;
        $isSuccess = true; // Mengaktifkan mode sukses pada view

        return view('pages.form-requirement', compact('sso', 'isSuccess'));
    }
}
