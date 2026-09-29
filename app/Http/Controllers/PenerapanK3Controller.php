<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenerapanK3Controller extends Controller
{
    public function index()
    {
        // Data Dummy Dokumen K3 standar industri sekolah
        $dokumens = [
            [
                'id' => 1,
                'nama_file' => 'SOP Keselamatan Praktikum Lab Komputer & Jaringan.pdf',
                'diunggah' => '12 Januari 2025',
                'file_size' => '2.4 MB'
            ],
            [
                'id' => 2,
                'nama_file' => 'Manual K3 Workshop Fiber Optik & Telekomunikasi.pdf',
                'diunggah' => '15 Januari 2025',
                'file_size' => '3.1 MB'
            ],
            [
                'id' => 3,
                'nama_file' => 'Prosedur Darurat & Evakuasi Kebakaran Gedung Sekolah.pdf',
                'diunggah' => '20 Januari 2025',
                'file_size' => '1.8 MB'
            ],
            [
                'id' => 4,
                'nama_file' => 'Pedoman Penggunaan Alat Pelindung Diri (APD) Siswa.pdf',
                'diunggah' => '25 Januari 2025',
                'file_size' => '4.0 MB'
            ]
        ];

        return view('pages.penerapan-k3', compact('dokumens'));
    }
}