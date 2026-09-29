<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Contoh Data Dummy Alumni (Bisa dihubungkan ke database nantinya)
        $allAlumni = [
            ['id' => 1, 'nama_siswa' => 'Ahmad Fauzi', 'jurusan' => 'SIJA', 'dtp' => '2023/2024', 'sso' => '541211001'],
            ['id' => 2, 'nama_siswa' => 'Siti Aminah', 'jurusan' => 'TJAT', 'dtp' => '2023/2024', 'sso' => '541211002'],
            ['id' => 3, 'nama_siswa' => 'Budi Santoso', 'jurusan' => 'SIJA', 'dtp' => '2022/2023', 'sso' => '541211003'],
            ['id' => 4, 'nama_siswa' => 'Dewi Lestari', 'jurusan' => 'TJAT', 'dtp' => '2022/2023', 'sso' => '541211004'],
            ['id' => 5, 'nama_siswa' => 'Reza Pratama', 'jurusan' => 'SIJA', 'dtp' => '2024/2025', 'sso' => '541211005'],
        ];

        // Filter pencarian berdasarkan Nama atau SSO
        $alumnis = $allAlumni;
        if ($search) {
            $alumnis = array_filter($allAlumni, function ($item) use ($search) {
                return str_contains(strtolower($item['nama_siswa']), strtolower($search)) || 
                       str_contains($item['sso'], $search);
            });
        }

        return view('pages.alumni', compact('alumnis', 'search'));
    }
}