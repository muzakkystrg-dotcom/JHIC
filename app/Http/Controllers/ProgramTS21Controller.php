<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramTS21Controller extends Controller
{
    /**
     * Menampilkan Halaman Program TS21 (Desktop - 31.png)
     */
    public function index()
    {
        $ts21Data = [
            'hero' => [
                'breadcrumb' => 'Program > Program TS21',
                'title' => 'Program TS21',
                'description' => 'Program TS.21 adalah kurikulum unggulan yang fokus pada Kompetensi Abad 21. Kami menerapkan Blended Learning, Project-Based, dan Studio Classroom untuk mencetak lulusan yang tangguh dan siap kerja.',
                'image' => asset('images/home/program.webp')
            ],
            'content' => [
                'heading' => 'TS.21 SMK Telkom Sidoarjo: Langkah Menuju Sekolah 4.0',
                'paragraphs' => [
                    'SMK Telkom Sidoarjo mengimplementasikan Kurikulum Merdeka TS.21 dengan fokus pada pembentukan Profil Lulusan yang seimbang antara Soft Skill (karakter baik & Digital Talent), Hard Skill, dan Life Skill Balance. Struktur kurikulum ini dirancang berlapis, dimulai dari jenjang PAUD hingga SMA/K, dengan penekanan pada pengembangan karakter berlandaskan Akhlak, Profil Pelajar Pancasila, dan TS Character. Porsi pembelajaran secara strategis mengalokasikan bobot yang proporsional untuk Attitude/Character serta Knowledge/Skill, memastikan pengembangan holistik pada setiap siswa.',
                    'Dari sisi implementasi, kurikulum ini berpusat pada Komunitas Belajar yang melibatkan sekolah, BPK YPT, guru, dan siswa, diperkuat dengan nara sumber profesional. Proses pembelajaran (KBM 21.40 Plis) bersifat terstandardisasi, berbasis ICT, interaktif, inovatif, dan menyenangkan, dengan interaksi yang berpusat pada siswa (student-centered), model hybrid learning, serta dukungan PUS (co/ekstrakurikuler), sentra, magang/PKL. Semua ini didukung oleh Skill Development (melalui Platform Merdeka Mengajar, webinar, training, guru magang) dan Digital Enabler (LMS, IGRACIAS, E-Library, SIAKAD, DITA/JIWA), untuk membentuk lulusan yang memiliki Hard Skill (penguasaan literasi & numerasi) dan Soft Skill (TS Character, Akhlak, Profil Pelajar Pancasila).'
                ]
            ]
        ];

        return view('pages.program-ts21', compact('ts21Data'));
    }
}