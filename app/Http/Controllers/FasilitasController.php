<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $facilities = [
            [
                'title' => 'Aula',
                'description' => 'Aula multifungsi yang digunakan untuk kegiatan sekolah seperti seminar, workshop, pertemuan wali murid, hingga acara internal dan eksternal sekolah.',
                'image' => asset('images/profile/gedung-utama.png') // atau placeholder jika belum ada
            ],
            [
                'title' => 'Gedung Smk Telkom Sidoarjo',
                'description' => 'Gedung utama SMK Telkom Sidoarjo yang representatif dengan desain modern serta fasilitas lengkap untuk menunjang kegiatan akademik maupun non-akademik siswa.',
                'image' => asset('images/facility/gedung-utama.png')
            ],
            [
                'title' => 'Kantin',
                'description' => 'Kantin merupakan fasilitas sekolah untuk tempat makan dan ruang bersosialisasi yang bersih dan nyaman. Kantin sekolah menjual berbagai macam pilihan makanan berat maupun makanan ringan dilengkapi dengan sistem transaksi cashless.',
                'image' => asset('images/facility/kantin.png')
            ]
        ];

        return view('pages.fasilitas', compact('facilities'));
    }
}