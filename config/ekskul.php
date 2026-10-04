<?php

/*
 * Daftar ekstrakurikuler (list) dan detail galeri (details, key = slug).
 */

return [
    'list' => [
        [
            'id' => 1,
            'name' => 'Paskibraka',
            'slug' => 'paskibraka',
            'image' => 'images/ekstra/paskib.webp',
        ],
        [
            'id' => 2,
            'name' => 'Futsal',
            'slug' => 'futsal',
            'image' => 'images/ekstra/futsal.webp',
        ],
        [
            'id' => 3,
            'name' => 'Esport',
            'slug' => 'esport',
            'image' => 'images/ekstra/esport.webp',
        ],
        [
            'id' => 4,
            'name' => 'Ambalan',
            'slug' => 'ambalan',
            'image' => 'images/ekstra/ambalan.webp',
        ],
    ],
    'details' => [
        'paskibraka' => [
            'nama' => 'Paskibraka',
            'slug' => 'paskibraka',
            'hero_image' => 'images/ekstra/paskibraka/hero-paskib.webp',
            'deskripsi' => 'Ekstrakurikuler Paskibraka merupakan kegiatan yang berfokus pada pembinaan kedisiplinan, kepemimpinan, serta rasa nasionalisme siswa melalui latihan baris-berbaris dan tata upacara bendera. Kegiatan ini melatih kekompakan, tanggung jawab, serta mental yang kuat dalam menjalankan tugas sebagai pengibar bendera pada berbagai kegiatan resmi sekolah.',
            'gallery' => [
                [
                    'image' => 'images/ekstra/paskibraka/galeri-1.webp',
                    'caption' => 'Kostum Biru-Hitam bersama Pembina di Depan UKS',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-2.webp',
                    'caption' => 'Formasi Kostum Biru-Hitam Barisan Lapangan',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-3.webp',
                    'caption' => 'Pasukan Kostum Merah-Hitam Topi Pet di Hanggar',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-4.webp',
                    'caption' => 'Latihan Baris Berbaris Pasukan Merah Siang Hari',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-5.webp',
                    'caption' => 'Momen Khidmat Pembawa Baki Bendera Merah Putih',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-6.webp',
                    'caption' => 'Foto Bersama Peringatan Hari Pendidikan Nasional',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-7.webp',
                    'caption' => 'Pasukan Kostum Merah Berbaris Rapi di Lapangan',
                ],
                [
                    'image' => 'images/ekstra/paskibraka/galeri-8.webp',
                    'caption' => 'Prestasi Juara LKBB Pandawa & Deretan Piala Emas',
                ],
            ],
        ],
        'futsal' => [
            'nama' => 'Futsal',
            'slug' => 'futsal',
            'hero_image' => 'images/ekstra/futsal.webp',
            'deskripsi' => 'Ekstrakurikuler Futsal membina bakat sepak bola mini, kerja sama tim, sportivitas, dan ketahanan fisik siswa untuk bertanding di kompetisi regional hingga nasional.',
            'gallery' => [
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Tim Futsal SMK Telkom Sidoarjo',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Sesi Latihan Taktikal Lapangan',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Turnamen Futsal Antar Pelajar',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Pemanasan Tim Sebelum Tanding',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Ekshibisi Bersama Alumni',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Strategi Pelatih Saat Time Out',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Latihan Fisik & Kecepatan',
                ],
                [
                    'image' => 'images/ekstra/futsal.webp',
                    'caption' => 'Selebrasi Kemenangan Juara',
                ],
            ],
        ],
        'esport' => [
            'nama' => 'Esport',
            'slug' => 'esport',
            'hero_image' => 'images/ekstra/esport.webp',
            'deskripsi' => 'Wadah pengembangan talenta gaming kompetitif siswa SMK Telkom Sidoarjo pada game strategi MOBA dan FPS dengan manajemen tim profesional dan sportivitas tinggi.',
            'gallery' => [
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Turnamen Mobile Legends Internal',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Sesi Scrim Match Antar Sekolah',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Briefing Taktik & Analisis Draft',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Kompetisi PUBG Mobile Pelajar',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Turnamen Free Fire Skomda',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Latihan Mental & Komunikasi Tim',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Perwakilan Lomba Tingkat Jatim',
                ],
                [
                    'image' => 'images/ekstra/esport.webp',
                    'caption' => 'Penyerahan Trophy Juara Esport',
                ],
            ],
        ],
        'ambalan' => [
            'nama' => 'Ambalan',
            'slug' => 'ambalan',
            'hero_image' => 'images/ekstra/ambalan.webp',
            'deskripsi' => 'Ambalan Penegak SMK Telkom Sidoarjo merupakan gugus depan Gerakan Pramuka yang mendidik generasi muda berkarakter, mandiri, cinta alam, dan berjiwa kepemimpinan Pancasila melalui kegiatan berkemah, keterampilan kepramukaan, serta pengabdian masyarakat.',
            'gallery' => [],
        ],
    ],
];
