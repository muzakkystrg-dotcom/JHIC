<?php

/*
 * Data halaman jurusan / program keahlian (key = sija|tjat).
 * `subjects` = daftar mata pelajaran, `works` = contoh karya siswa.
 */

return [
    'sija' => [
        'subjects' => [
            'Kelompok Mata Pelajaran Nasional',
            'Kelompok Mata Pelajaran Peminatan',
            'Platform Komputasi Awan',
            'Produk Kreatif dan Kewirausahaan',
            'Pemrograman Dasar',
            'Infrastruktur Komputasi Awan',
            'Sistem Keamanan Jaringan',
            'Kelompok Mata Pelajaran Kewilayahan',
            'Komputer dan Jaringan Dasar',
            'Sistem Internet of Things (SIoT)',
            'Sistem Komputer',
            'Dasar Desain Grafis',
            'Layanan Komputasi Awan',
            'Materi sinkronisasi dengan industri',
        ],
        'works' => [
            ['title' => 'Website Berbasis AI', 'image' => 'images/home/berita.webp'],
            ['title' => 'Website Berbasis AI', 'image' => 'images/home/berita.webp'],
            ['title' => 'Website Berbasis AI', 'image' => 'images/home/berita.webp'],
        ],
    ],
    'tjat' => [
        'subjects' => [
            'Jaringan Fiber Optic',
            'Jaringan Komputer',
            'Jaringan Nirkabel / Wireless',
            'Pemrograman Web',
            'Desain Grafis',
            'Internet of Things (IoT)',
            'Sistem Keamanan Jaringan',
            'Produk Kreatif dan Kewirausahaan',
            'Materi sinkronisasi dengan industri',
        ],
        'works' => [
            ['title' => 'Palang Pintu Otomatis', 'image' => 'images/home/berita.webp'],
            ['title' => 'Teknologi Smarthome', 'image' => 'images/home/berita.webp'],
            ['title' => 'Jemuran Otomatis', 'image' => 'images/home/berita.webp'],
        ],
    ],
];
