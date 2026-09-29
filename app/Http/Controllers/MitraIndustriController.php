<?php

namespace App\Http\Controllers;

class MitraIndustriController extends Controller
{
    public function index()
    {
        $mitras = [
            [
                'name' => 'Axelbit',
                'location' => 'Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',
                'description' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi.',
                'logo' => asset('images/mitra/axelbit.png'),
                'website' => '#',
            ],
            [
                'name' => 'DigiPrener',
                'location' => 'Taman Bungkul Street No. 25, Surabaya, Jawa Timur 60241',
                'description' => 'Jl. Sukomanunggal Tanjung Sari Baru IV, Tanjungsari, Kec. Sukomanunggal, Surabaya, Jawa Timur 60226. Axelbit merupakan training center di bidang jaringan dan teknologi wireless yang menyediakan pelatihan serta sertifikasi profesional.',
                'logo' => asset('images/mitra/digi.png'),
                'website' => '#',
            ],
            [
                'name' => 'Jagoan Hosting',
                'location' => 'Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',
                'description' => 'Jagoan Hosting Indonesia merupakan perusahaan penyedia layanan web hosting, domain, dan cloud service di Indonesia.',
                'logo' => asset('images/mitra/jagoanhosting.png'),
                'website' => '#',
            ],
            [
                'name' => 'Markaz Design',
                'location' => 'Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61226',
                'description' => 'Markaz Design merupakan konsultan kreatif berbasis di Sidoarjo yang berfokus pada pengembangan UMKM melalui solusi branding dan strategi bisnis.',
                'logo' => asset('images/mitra/markaz.png'),
                'website' => '#',
            ],
            [
                'name' => 'Pt. Garuda Telekomunikasi Indonesia',
                'location' => 'Surabaya, Indonesia',
                'description' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur.',
                'logo' => asset('images/mitra/gt.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT Global Infra Teknologi',
                'location' => 'Kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',
                'description' => 'PT Global Infra Teknologi merupakan perusahaan penyedia layanan internet dan solusi teknologi informasi di Indonesia. Berbasis di Surabaya, perusahaan ini menawarkan layanan pengelolaan IT terpadu.',
                'logo' => asset('images/mitra/gi.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT Javacreatiox Network Intermedia',
                'location' => 'Kec. Wonocolo, Surabaya, Jawa Timur 60237',
                'description' => 'PT Javacreatiox Network Intermedia merupakan perusahaan yang bergerak di bidang teknologi informasi dengan layanan utama meliputi web development, instalasi CCTV, Internet of Things (IoT), serta IT support.',
                'logo' => asset('images/mitra/javacreat.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT Radnet Digital Indonesia',
                'location' => 'Kec. Genteng, Surabaya, Jawa Timur 60271',
                'description' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan.',
                'logo' => asset('images/mitra/radnext.png'),
                'website' => '#',
            ],
            [
                'name' => 'Wowrack Indonesia',
                'location' => 'Kec. Genteng, Surabaya, Jawa Timur 60275',
                'description' => 'Wowrack Indonesia merupakan perusahaan penyedia layanan teknologi informasi yang berfokus pada cloud computing, data center, dan hosting.',
                'logo' => asset('images/mitra/wowrack.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT. Garuda Telekomunikasi Indonesia',
                'location' => 'Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',
                'description' => 'PT Javacreatiox Network Intermedia merupakan perusahaan yang bergerak di bidang teknologi informasi dengan layanan utama meliputi web development, instalasi CCTV, Internet of Things (IoT), serta IT support.',
                'logo' => asset('images/mitra/gt.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT. Global Infra Teknologi',
                'location' => 'Kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',
                'description' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi.',
                'logo' => asset('images/mitra/gi.png'),
                'website' => '#',
            ],
            [
                'name' => 'PT. RADNET DIGITAL INDONESIA',
                'location' => 'Kec. Genteng, Surabaya, Jawa Timur 60271',
                'description' => 'PT. RADNET DIGITAL INDONESIA (radneXt) adalah Internet Service Provider (ISP) resmi berlisensi Kementerian Komunikasi dan Informatika RI.',
                'logo' => asset('images/mitra/radnext.png'),
                'website' => '#',
            ],
            [
                'name' => 'Weza Group - PT Weza Punya Cerita',
                'location' => 'Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61217',
                'description' => 'PT Weza Punya Cerita merupakan perusahaan teknologi yang berfokus pada penyediaan solusi B2B melalui layanan unggulannya, Weza Solutions.',
                'logo' => asset('images/mitra/weza.png'),
                'website' => '#',
            ],
        ];

        return view('pages.mitra-industri', compact('mitras'));
    }
}
