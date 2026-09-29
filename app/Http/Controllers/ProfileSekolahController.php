<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $visiMisi = [
            'visi' => 'Mewujudkan Lulusan Tangguh, Berakhlak, dan Berwawasan Digital',
            'misi' => [
                'Mengembangkan sistem pembinaan peserta didik untuk membentuk lulusan yang berkarakter tangguh, berakhlak, dan berwawasan digital.',
                'Menyelenggarakan pendidikan dengan kurikulum Link and Match di bidang Teknologi Informasi.',
                'Mewujudkan lulusan yang memiliki pengetahuan dan keterampilan siap untuk Bekerja, Melanjutkan, atau Wirausaha (BMW).'
            ]
        ];

        return view('pages.profile-sekolah', compact('visiMisi'));
    }
}