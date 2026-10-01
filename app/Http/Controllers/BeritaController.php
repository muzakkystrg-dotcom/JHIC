<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $categories = [
            'Semua', 
            'Prestasi', 
            'Kegiatan Sekolah', 
            'Pengumuman', 
            'Kemitraan & Kerja Sama', 
            'Karya & Inovasi Siswa', 
            'Artikel & edukasi', 
            'Alumni'
        ];

        // Menggunakan gambar juara.png dari folder images/berita/
        $beritas = [];
        for ($i = 1; $i <= 10; $i++) {
            $beritas[] = [
                'id' => $i,
                'title' => 'Lomba Matematika SMP/MTs Terbesar Se-Sidoarjo Sukses Digelar di SKOMDA',
                'category' => 'Kegiatan Sekolah',
                'published_at' => '2025-11-27T19:24:35',
                'thumbnail' => asset('images/berita/juara.png')
            ];
        }

        return view('pages.berita', compact('categories', 'beritas'));
    }
}