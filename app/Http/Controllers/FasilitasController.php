<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Menampilkan Halaman Fasilitas SMK Telkom Sidoarjo
     */
    public function index()
    {
        $fasilitas = [
            [
                'id' => 1,
                'name' => 'Gedung Sekolah',
                'category' => 'Infrastruktur',
                'image' => asset('images/fasilitas/gedung.png'),
            ],
            [
                'id' => 2,
                'name' => 'Kantin Sehat',
                'category' => 'Fasilitas Umum',
                'image' => asset('images/fasilitas/kantin.png'),
            ],
            [
                'id' => 3,
                'name' => 'Lab Artificial Intelligence',
                'category' => 'Laboratorium',
                'image' => asset('images/fasilitas/lab-ai.png'),
            ],
            [
                'id' => 4,
                'name' => 'Lab Internet of Things (IoT)',
                'category' => 'Laboratorium',
                'image' => asset('images/fasilitas/lab-iot.png'),
            ],
            [
                'id' => 5,
                'name' => 'Lab Komputer & Jaringan',
                'category' => 'Laboratorium',
                'image' => asset('images/fasilitas/lab-kom.png'),
            ],
            [
                'id' => 6,
                'name' => 'Lapangan Basket',
                'category' => 'Sarana Olahraga',
                'image' => asset('images/fasilitas/lap-basket.png'),
            ],
            [
                'id' => 7,
                'name' => 'OC Besar',
                'category' => 'Ruang Kolaborasi',
                'image' => asset('images/fasilitas/oc-besar.png'),
            ],
            [
                'id' => 8,
                'name' => 'OC Kecil',
                'category' => 'Ruang Kolaborasi',
                'image' => asset('images/fasilitas/oc-kecil.png'),
            ],
        ];

        return view('pages.fasilitas', compact('fasilitas'));
    }
}