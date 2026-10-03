<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Master Dataset Ekstrakurikuler & Galeri Kegiatan
     */
    private function getEkstraDataset()
    {
        return [
            'paskibraka' => [
                'nama' => 'Paskibraka',
                'slug' => 'paskibraka',
                'hero_image' => asset('images/ekstra/paskibraka/hero-paskib.png'),
                'deskripsi' => 'Ekstrakurikuler Paskibraka merupakan kegiatan yang berfokus pada pembinaan kedisiplinan, kepemimpinan, serta rasa nasionalisme siswa melalui latihan baris-berbaris dan tata upacara bendera. Kegiatan ini melatih kekompakan, tanggung jawab, serta mental yang kuat dalam menjalankan tugas sebagai pengibar bendera pada berbagai kegiatan resmi sekolah.',
                'gallery' => [
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-1.png'),
                        'caption' => 'Kostum Biru-Hitam bersama Pembina di Depan UKS'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-2.png'),
                        'caption' => 'Formasi Kostum Biru-Hitam Barisan Lapangan'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-3.png'),
                        'caption' => 'Pasukan Kostum Merah-Hitam Topi Pet di Hanggar'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-4.png'),
                        'caption' => 'Latihan Baris Berbaris Pasukan Merah Siang Hari'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-5.png'),
                        'caption' => 'Momen Khidmat Pembawa Baki Bendera Merah Putih'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-6.png'),
                        'caption' => 'Foto Bersama Peringatan Hari Pendidikan Nasional'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-7.png'),
                        'caption' => 'Pasukan Kostum Merah Berbaris Rapi di Lapangan'
                    ],
                    [
                        'image' => asset('images/ekstra/paskibraka/galeri-8.png'),
                        'caption' => 'Prestasi Juara LKBB Pandawa & Deretan Piala Emas'
                    ],
                ]
            ],
            'futsal' => [
                'nama' => 'Futsal',
                'slug' => 'futsal',
                'hero_image' => asset('images/ekstra/futsal.png'),
                'deskripsi' => 'Ekstrakurikuler Futsal membina bakat sepak bola mini, kerja sama tim, sportivitas, dan ketahanan fisik siswa untuk bertanding di kompetisi regional hingga nasional.',
                'gallery' => [
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Tim Futsal SMK Telkom Sidoarjo'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Sesi Latihan Taktikal Lapangan'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Turnamen Futsal Antar Pelajar'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Pemanasan Tim Sebelum Tanding'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Ekshibisi Bersama Alumni'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Strategi Pelatih Saat Time Out'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Latihan Fisik & Kecepatan'],
                    ['image' => asset('images/ekstra/futsal.png'), 'caption' => 'Selebrasi Kemenangan Juara'],
                ]
            ],
            'esport' => [
                'nama' => 'Esport',
                'slug' => 'esport',
                'hero_image' => asset('images/ekstra/esport.png'),
                'deskripsi' => 'Wadah pengembangan talenta gaming kompetitif siswa SMK Telkom Sidoarjo pada game strategi MOBA dan FPS dengan manajemen tim profesional dan sportivitas tinggi.',
                'gallery' => [
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Turnamen Mobile Legends Internal'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Sesi Scrim Match Antar Sekolah'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Briefing Taktik & Analisis Draft'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Kompetisi PUBG Mobile Pelajar'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Turnamen Free Fire Skomda'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Latihan Mental & Komunikasi Tim'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Perwakilan Lomba Tingkat Jatim'],
                    ['image' => asset('images/ekstra/esport.png'), 'caption' => 'Penyerahan Trophy Juara Esport'],
                ]
            ],
            'pramuka' => [
                'nama' => 'Pramuka',
                'slug' => 'pramuka',
                'hero_image' => asset('images/ekstra/paskib.png'),
                'deskripsi' => 'Gerakan Pramuka Gugus Depan SMK Telkom Sidoarjo mendidik generasi muda yang berkarakter, mandiri, cinta alam, dan memiliki jiwa kepemimpinan pancasila.',
                'gallery' => []
            ],
            'basket' => [
                'nama' => 'Basket',
                'slug' => 'basket',
                'hero_image' => asset('images/ekstra/futsal.png'),
                'deskripsi' => 'Ekstrakurikuler Bola Basket mengasah fundamental dribbling, shooting, passing, dan stamina tanding di kejuaraan DBL serta piala daerah.',
                'gallery' => []
            ],
            'robotik' => [
                'nama' => 'Robotik & Coding',
                'slug' => 'robotik',
                'hero_image' => asset('images/ekstra/esport.png'),
                'deskripsi' => 'Klub robotik dan rekayasa kecerdasan buatan tempat siswa merancang line follower, IoT automation, dan mikrokontroler Arduino/ESP32.',
                'gallery' => []
            ],
        ];
    }

    /**
     * Menampilkan Katalog Ekstrakurikuler (Desktop - 27)
     */
    public function index()
    {
        $dataset = $this->getEkstraDataset();
        
        $ekstras = [
            ['id' => 1, 'name' => 'Paskibraka', 'slug' => 'paskibraka', 'image' => asset('images/ekstra/paskib.png')],
            ['id' => 2, 'name' => 'Futsal', 'slug' => 'futsal', 'image' => asset('images/ekstra/futsal.png')],
            ['id' => 3, 'name' => 'Esport', 'slug' => 'esport', 'image' => asset('images/ekstra/esport.png')],
            ['id' => 4, 'name' => 'Pramuka', 'slug' => 'pramuka', 'image' => asset('images/ekstra/paskib.png')],
            ['id' => 5, 'name' => 'Basket', 'slug' => 'basket', 'image' => asset('images/ekstra/futsal.png')],
            ['id' => 6, 'name' => 'Robotik & Coding', 'slug' => 'robotik', 'image' => asset('images/ekstra/esport.png')],
        ];

        $clubs = [
            ['name' => 'Badminton'],
            ['name' => 'Voli'],
            ['name' => 'Voli'],
        ];

        $ekstraDetail = null;
        $prevSlug = null;
        $nextSlug = null;

        return view('pages.ekstrakurikuler', compact('ekstras', 'clubs', 'ekstraDetail', 'prevSlug', 'nextSlug'));
    }

    /**
     * Menampilkan Halaman Detail Ekstrakurikuler Dinamis (Desktop - 40)
     */
    public function show($slug)
    {
        $dataset = $this->getEkstraDataset();
        $slugKeys = array_keys($dataset);

        if (!array_key_exists($slug, $dataset)) {
            $slug = 'paskibraka';
        }

        $ekstraDetail = $dataset[$slug];

        // Navigasi Prev & Next melingkar
        $currentIndex = array_search($slug, $slugKeys);
        $prevIndex = ($currentIndex - 1 + count($slugKeys)) % count($slugKeys);
        $nextIndex = ($currentIndex + 1) % count($slugKeys);

        $prevSlug = $slugKeys[$prevIndex];
        $nextSlug = $slugKeys[$nextIndex];

        $ekstras = [];
        $clubs = [];

        return view('pages.ekstrakurikuler', compact('ekstras', 'clubs', 'ekstraDetail', 'prevSlug', 'nextSlug'));
    }
}