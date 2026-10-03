<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
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
        $lowongans = [
            [
                'id' => 1,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.webp'),
            ],
            [
                'id' => 2,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.webp'),
            ],
            [
                'id' => 3,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.webp'),
            ],
            [
                'id' => 4,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.webp'),
            ],
            [
                'id' => 5,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.webp'),
            ],
        ];

        $events = [
            [
                'day' => '8',
                'month' => 'September',
                'title' => 'Sidoarjo School & Job Fair 2026',
                'location' => 'Lippo Mall Sidoarjo',
                'is_ended' => false,
            ],
            [
                'day' => '9',
                'month' => 'Juli',
                'title' => 'Workshop: AI dan Bisnis',
                'location' => 'Aula SMK TELKOM SIDOARJO',
                'is_ended' => true,
            ],
        ];

        $testimonials = [
            [
                'quote' => 'Sekolah disini asyik banget, gabakal nyesel buat para orang tuah yang nyari calon sekolah buat anaknya sih!',
                'author' => 'Aisyah SIJA • Institut Teknologi Bandung',
                'role' => 'Alumni SMK Telkom Sidoarjo',
            ]
        ];

        return view('pages.career-center', compact('lowongans', 'events', 'testimonials'));
    }

    /**
     * Menampilkan Halaman Verifikasi SSO
     */
    public function ssoForm()
    {
        return view('pages.sso-form');
    }

    /**
     * Direktori siswa sementara untuk verifikasi SSO.
     *
     * TODO: ganti dengan sumber data resmi sekolah (database/API SSO).
     * Sebelum sumber resmi tersedia, HANYA nomor SSO di bawah ini yang lolos,
     * sehingga verifikasi tetap gagal-tertutup (fail-closed) untuk input lain.
     */
    private const STUDENT_DIRECTORY = [
        '541211001' => [
            'sso' => '541211001',
            'name' => 'Ahmad Fauzi',
            'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
            'dtp' => '2023/2024',
        ],
        '541211002' => [
            'sso' => '541211002',
            'name' => 'Siti Aminah',
            'major' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
            'dtp' => '2023/2024',
        ],
        '541211003' => [
            'sso' => '541211003',
            'name' => 'Budi Santoso',
            'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
            'dtp' => '2022/2023',
        ],
        '541211004' => [
            'sso' => '541211004',
            'name' => 'Dewi Lestari',
            'major' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
            'dtp' => '2022/2023',
        ],
        '541211005' => [
            'sso' => '541211005',
            'name' => 'Reza Pratama',
            'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
            'dtp' => '2024/2025',
        ],
    ];

    /**
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
     * Cari siswa berdasarkan nomor SSO.
     *
     * @return array{sso:string,name:string,major:string,dtp:string}|null
     */
    private function findStudentBySso(string $sso): ?array
    {
        return self::STUDENT_DIRECTORY[trim($sso)] ?? null;
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