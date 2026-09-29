<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrialClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Data Dummy Jadwal Sesi Trial Class
        $allClasses = [
            [
                'id' => 1,
                'judul' => 'Eksplorasi Jaringan Fiber Optik & 5G',
                'jurusan' => 'TJAT',
                'tanggal' => '10 Februari 2026',
                'jam' => '09:00 - 11:30 WIB',
                'instruktur' => 'Tim Lab Telekomunikasi',
                'kuota' => '25 Siswa'
            ],
            [
                'id' => 2,
                'judul' => 'Pemrograman Web & UI/UX Design Dasar',
                'jurusan' => 'SIJA',
                'tanggal' => '12 Februari 2026',
                'jam' => '13:00 - 15:30 WIB',
                'instruktur' => 'Tim Produktif SIJA',
                'kuota' => '25 Siswa'
            ],
            [
                'id' => 3,
                'judul' => 'Smart Home Automation berbasis IoT',
                'jurusan' => 'SIJA / TJAT',
                'tanggal' => '15 Februari 2026',
                'jam' => '09:00 - 11:30 WIB',
                'instruktur' => 'Tim IoT Lab RPS Hall',
                'kuota' => '20 Siswa'
            ],
        ];

        // Filter pencarian
        $classes = $allClasses;
        if ($search) {
            $classes = array_filter($allClasses, function($item) use ($search) {
                return str_contains(strtolower($item['judul']), strtolower($search)) || 
                       str_contains(strtolower($item['jurusan']), strtolower($search));
            });
        }

        return view('pages.trial-class', compact('classes', 'search'));
    }
}