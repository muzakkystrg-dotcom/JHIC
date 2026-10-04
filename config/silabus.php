<?php

/*
 * Data silabus SIJA dan TJAT (key = sija|tjat).
 */

return [
    'sija' => [
        'code' => 'SIJA',
        'title' => 'SIJA — Sistem Informasi Jaringan & Aplikasi',
        'duration' => 'Program Keahlian 4 Tahun | Siap Skala Industri',
        'hero_desc' => 'Dalam program 4 tahun ini, kamu tidak hanya dilatih membangun infrastruktur jaringan, tetapi juga mendalami integrasi cloud computing, pemrograman, hingga penerapan Internet of Things (IoT) dan sistem keamanan jaringan untuk menghasilkan solusi digital yang aman, elastis, serta siap pakai di skala industri.',
        'hero_image' => 'images/career/career.webp',
        'spec_career' => 'Cloud Engineer, Fullstack, Cyber Security, UI Designer',
        'spec_competency' => 'Pemrograman, Pembuatan Aplikasi, Keamanan Jaringan',
        'spec_path' => 'Linier ke jurusan Teknik Informatika, Sistem Informasi',
        'curriculum_semesters' => [
            [
                'sem' => 'Semester 1 - 2',
                'focus' => 'Dasar Pemrograman, Jaringan Dasar, Sistem Komputer, & Logika Algoritma',
            ],
            [
                'sem' => 'Semester 3 - 4',
                'focus' => 'Pemrograman Web & Mobile, Basis Data Relasional, Administrasi Server',
            ],
            [
                'sem' => 'Semester 5 - 6',
                'focus' => 'Cloud Infrastructure (AWS/GCP), Internet of Things (IoT), Cyber Security',
            ],
            [
                'sem' => 'Semester 7 - 8',
                'focus' => 'Praktik Kerja Industri 1 Tahun (Full Internship Industri) & Capstone Project',
            ],
        ],
    ],
    'tjat' => [
        'code' => 'TJAT',
        'title' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
        'duration' => 'Program Keahlian 3 Tahun | Siap Skala Industri',
        'hero_desc' => 'Jurusan ini memfokuskan pembelajaran pada perancangan, instalasi, pemeliharaan, hingga optimasi jaringan transmisi—mulai dari teknologi fiber optic hingga komunikasi nirkabel (wireless)—guna memastikan ketersediaan konektivitas data berkecepatan tinggi yang stabil dari penyedia layanan (provider) hingga ke pengguna akhir.',
        'hero_image' => null,
        'spec_career' => 'Fiber Optic Technician, Network Engineer, etc.',
        'spec_competency' => 'Wireless Communications, Network Optimization, etc.',
        'spec_path' => 'Linier ke jurusan Teknik Elektro, Teknik Komputer, etc.',
        'curriculum_semesters' => [
            [
                'sem' => 'Semester 1 - 2',
                'focus' => 'Dasar Telekomunikasi, Rangkaian Listrik & Elektronika, Keselamatan Kerja K3',
            ],
            [
                'sem' => 'Semester 3 - 4',
                'focus' => 'Teknologi Fiber Optik (Splicing & OTDR), Transmisi Radio & VSAT, Jaringan Seluler',
            ],
            [
                'sem' => 'Semester 5 - 6',
                'focus' => 'Sistem Komunikasi Nirkabel Modern, PKL Industri Telekomunikasi & Uji Sertifikasi BNSP',
            ],
        ],
    ],
];
