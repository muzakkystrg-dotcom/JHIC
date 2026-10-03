<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Menampilkan Halaman Jurusan SIJA (Desktop - 26)
     */
    public function sija()
    {
        $subjects = [
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
        ];

        $works = [
            [
                'title' => 'Website Berbasis AI',
                'image' => asset('images/home/berita.webp')
            ],
            [
                'title' => 'Website Berbasis AI',
                'image' => asset('images/home/berita.webp')
            ],
            [
                'title' => 'Website Berbasis AI',
                'image' => asset('images/home/berita.webp')
            ],
        ];

        return view('pages.sija', compact('subjects', 'works'));
    }

    /**
     * Menampilkan Halaman Jurusan TJAT (Desktop - 28)
     */
    public function tjat()
    {
        $subjects = [
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Nasional',
        ];

        $works = [
            [
                'title' => 'Palang Pintu Otomatis',
                'image' => asset('images/home/berita.webp')
            ],
            [
                'title' => 'Teknologi Smarthome',
                'image' => asset('images/home/berita.webp')
            ],
            [
                'title' => 'Jemuran Otomatis',
                'image' => asset('images/home/berita.webp')
            ],
        ];

        return view('pages.tjat', compact('subjects', 'works'));
    }
}