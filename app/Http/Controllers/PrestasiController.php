<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $chartData = [
            'labels' => ['Kabupaten', 'Provinsi', 'Nasional', 'Internasional'],
            'data' => [60, 60, 170, 0]
        ];

        $achievements = [
            [
                'title' => 'Para Juara - Generative AI Web Design',
                'category' => '🖥️🏆 Skill digital, naik level!',
                'description' => 'Tiga siswa SKOMDA berhasil membawa pulang prestasi dari Intermedia Information Technology Competition (IITC) 2026 yang diselenggarakan Universitas Amikom Purwokerto. 🚀',
                'image' => asset('images/prestasi/juara.webp')
            ],
            [
                'title' => 'Juara 1 LKS Web Technologies Tingkat Nasional',
                'category' => '💻🥇 Kompetensi keahlian unggul',
                'description' => 'Siswa jurusan SIJA sukses mendominasi ajang LKS Nasional melalui inovasi web application development berstandar industri.',
                'image' => asset('images/prestasi/juara.webp')
            ],
            [
                'title' => 'Medali Emas Olimpiade Jaringan Komputer',
                'category' => '🌐🏅 Networking champion',
                'description' => 'Prestasi membanggakan di bidang infrastruktur jaringan telekomunikasi dan konfigurasi router tingkat regional.',
                'image' => asset('images/prestasi/juara.webp')
            ]
        ];

        return view('pages.prestasi', compact('chartData', 'achievements'));
    }
}