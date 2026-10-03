<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'logo' => asset('images/mitra/gt.png'),
            ],
            [
                'id' => 2,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.png'),
            ],
            [
                'id' => 3,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.png'),
            ],
            [
                'id' => 4,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.png'),
            ],
            [
                'id' => 5,
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Ind...',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'posted_at' => '1 Hari Yang Lalu',
                'logo' => asset('images/mitra/gt.png'),
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
     * AJAX Check SSO Siswa
     */
    public function checkSso(Request $request)
    {
        $request->validate([
            'sso' => 'required|string|max:50'
        ]);

        $ssoInput = $request->input('sso');

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa terverifikasi',
            'data' => [
                'sso' => $ssoInput,
                'name' => 'Ahmad Dwi Santoso',
                'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
                'dtp' => '2023/2024',
                'email' => 'ahmaddwi@student.telkomsda.sch.id',
                'phone' => '081234567890'
            ]
        ]);
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
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
        ]);

        // Simpan data pelamar (diserahkan ke backend developer nantinya)
        // ...

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