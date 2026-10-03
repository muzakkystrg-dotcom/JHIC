<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramCCPController extends Controller
{
    /**
     * Menampilkan Halaman Program CCP (Desktop - 30.png)
     */
    public function index()
    {
        $ccpData = [
            'hero' => [
                'breadcrumb' => 'Program > Program CCP',
                'title' => 'Program CCP',
                'description' => 'Program Pendidikan CCP SMK Telkom Sidoarjo membekali siswa dengan skill tambahan dan kreativitas yang relevan dengan industri. Program ini memastikan lulusan siap kerja dan berdaya saing global. Jelajahi detail Program CCP kami.',
                'image' => asset('images/ccp/hero-ccp.png')
            ],
            'pillars' => [
                'character' => [
                    'title' => 'Program Character',
                    'desc' => 'Program ini berfokus pada pembentukan karakter unggul, etika, dan soft skill siswa agar siap menjadi profesional berintegritas',
                    'items' => [
                        'Program SCBC',
                        'Pramuka',
                        'Kegiatan Rohani',
                        'Pengembangan Soft Skill'
                    ]
                ],
                'process' => [
                    'title' => 'Program Process',
                    'desc' => 'Pembelajaran dirancang interaktif, berbasis ICT, dan menggunakan metode Project Based Learning untuk penguasaan kompetensi yang aplikatif.',
                    'items' => [
                        'Menggunakan CAFE',
                        'Berbasis ICT (terkait fasilitas)',
                        'Pembelajaran Interaktif',
                        'Project Based Learning'
                    ]
                ],
                'content' => [
                    'title' => 'Program Content',
                    'desc' => 'Kami menyajikan materi pelajaran yang relevan dengan industri (Link and Match) dan diperkuat dengan program Bahasa Inggris untuk meningkatkan daya saing global.',
                    'items' => [
                        'Kurikulum Nasional',
                        'Link and Match dengan DUDI (Dunia Usaha dan Industri)',
                        'English program: pelatihan bahasa Inggris untuk guru, English day setiap Kamis, dan English corner di ruang TU dan guru'
                    ]
                ]
            ]
        ];

        return view('pages.program-ccp', compact('ccpData'));
    }
}