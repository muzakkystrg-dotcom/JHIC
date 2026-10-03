<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MitraIndustriController extends Controller
{
    /**
     * Dataset Master 13 Mitra Industri Resmi SMK Telkom Sidoarjo
     */
    private function getMitraDataset()
    {
        return [
            'axelbit' => [
                'nama' => 'Axelbit',
                'slug' => 'axelbit',
                'alamat' => 'Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',
                'deskripsi' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi.',
                'website_url' => 'https://axelbit.com',
                'website_label' => 'axelbit.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/axelbit.webp'),
                'jobs' => [
                    [
                        'title' => 'Network Technician',
                        'company' => 'Axelbit Solutions',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '2 Hari Yang Lalu',
                        'logo' => asset('images/mitra/axelbit.webp'),
                    ]
                ]
            ],
            'digiprener' => [
                'nama' => 'DigiPrener',
                'slug' => 'digiprener',
                'alamat' => 'Taman Bungkul Street No. 25, Surabaya, Jawa Timur 60241, Jl. Sukomanunggal Tanjung Sari Baru IV, Tanjungsari, Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',
                'deskripsi' => 'Axelbit merupakan training center di bidang jaringan dan teknologi wireless yang menyediakan pelatihan serta sertifikasi profesional.',
                'website_url' => 'https://digiprener.id',
                'website_label' => 'digiprener.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/digi.webp'),
                'jobs' => [
                    [
                        'title' => 'Junior Web Developer',
                        'company' => 'DigiPrener Tech',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '1 Hari Yang Lalu',
                        'logo' => asset('images/mitra/digi.webp'),
                    ]
                ]
            ],
            'jagoan-hosting' => [
                'nama' => 'Jagoan Hosting',
                'slug' => 'jagoan-hosting',
                'alamat' => 'Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',
                'deskripsi' => 'Jagoan Hosting Indonesia merupakan perusahaan penyedia layanan web hosting, domain, dan cloud service di Indonesia.',
                'website_url' => 'https://jagoanhosting.com',
                'website_label' => 'jagoanhosting.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/jagoanhosting.webp'),
                'jobs' => [
                    [
                        'title' => 'Cloud System Support',
                        'company' => 'Jagoan Hosting Indonesia',
                        'location' => 'Malang, Indonesia',
                        'posted' => '3 Hari Yang Lalu',
                        'logo' => asset('images/mitra/jagoanhosting.webp'),
                    ]
                ]
            ],
            'markaz-design' => [
                'nama' => 'Markaz Design',
                'slug' => 'markaz-design',
                'alamat' => 'Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61226',
                'deskripsi' => 'Markaz Design merupakan konsultan kreatif berbasis di Sidoarjo yang berfokus pada pengembangan UMKM melalui solusi branding dan strategi bisnis.',
                'website_url' => 'https://markazdesign.id',
                'website_label' => 'markazdesign.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/markaz.webp'),
                'jobs' => [
                    [
                        'title' => 'Creative Graphic Designer',
                        'company' => 'Markaz Design Studio',
                        'location' => 'Sidoarjo, Indonesia',
                        'posted' => '1 Hari Yang Lalu',
                        'logo' => asset('images/mitra/markaz.webp'),
                    ]
                ]
            ],
            'pt-garuda-telekomunikasi-indonesia' => [
                'nama' => 'Pt. Garuda Telekomunikasi Indonesia',
                'slug' => 'pt-garuda-telekomunikasi-indonesia',
                'alamat' => 'Jl. Muria Jl. Pepelegi Indah No.47, Pepe, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',
                'deskripsi' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi serta solusi teknologi informasi untuk mendukung kebutuhan operasional bisnis secara efektif dan berkelanjutan.',
                'website_url' => 'https://ptgaruda-telkomind.com',
                'website_label' => 'ptgaruda-telkomind.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/gt.webp'),
                'jobs' => [
                    [
                        'title' => 'Junior DevOps',
                        'company' => 'Pt. Garuda Telekomunikasi Ind...',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '1 Hari Yang Lalu',
                        'logo' => asset('images/mitra/gt.webp'),
                    ]
                ]
            ],
            'pt-global-infra-teknologi' => [
                'nama' => 'PT Global Infra Teknologi',
                'slug' => 'pt-global-infra-teknologi',
                'alamat' => 'kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',
                'deskripsi' => 'T Global Infra Teknologi merupakan perusahaan penyedia layanan internet dan solusi teknologi informasi di Indonesia. Berbasis di Surabaya, perusahaan ini menawarkan layanan pengelolaan IT yang ditujukan untuk berbagai sektor seperti korporasi,',
                'website_url' => 'https://globalinfratek.co.id',
                'website_label' => 'globalinfratek.co.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/gi.webp'),
                'jobs' => []
            ],
            'pt-javacreatiox-network-intermedia' => [
                'nama' => 'PT Javacreatiox Network Intermedia',
                'slug' => 'pt-javacreatiox-network-intermedia',
                'alamat' => 'Kec. Wonocolo, Surabaya, Jawa Timur 60237',
                'deskripsi' => 'PT Javacreatiox Network Intermedia merupakan perusahaan yang bergerak di bidang teknologi informasi dengan layanan utama meliputi web development, instalasi CCTV, Internet of Things (IoT), serta IT support.',
                'website_url' => 'https://javacreatiox.com',
                'website_label' => 'javacreatiox.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/javacreat.webp'),
                'jobs' => [
                    [
                        'title' => 'Fullstack Developer Trainee',
                        'company' => 'PT Javacreatiox Network',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '2 Hari Yang Lalu',
                        'logo' => asset('images/mitra/javacreat.webp'),
                    ]
                ]
            ],
            'pt-radnet-digital-indonesia' => [
                'nama' => 'PT Radnet Digital Indonesia',
                'slug' => 'pt-radnet-digital-indonesia',
                'alamat' => 'Kec. Genteng, Surabaya, Jawa Timur 60271',
                'deskripsi' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi',
                'website_url' => 'https://radnet.id',
                'website_label' => 'radnet.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/radnext.webp'),
                'jobs' => [
                    [
                        'title' => 'Technical Support NOC',
                        'company' => 'PT Radnet Digital Indonesia',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '1 Hari Yang Lalu',
                        'logo' => asset('images/mitra/radnext.webp'),
                    ]
                ]
            ],
            'wowrack-indonesia' => [
                'nama' => 'Wowrack Indonesia',
                'slug' => 'wowrack-indonesia',
                'alamat' => 'Kec. Genteng, Surabaya, Jawa Timur 60275',
                'deskripsi' => 'Wowrack Indonesia merupakan perusahaan penyedia layanan teknologi informasi yang berfokus pada cloud computing, data center, dan hosting.',
                'website_url' => 'https://wowrack.co.id',
                'website_label' => 'wowrack.co.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/wowrack.webp'),
                'jobs' => [
                    [
                        'title' => 'Data Center Technician',
                        'company' => 'Wowrack Indonesia',
                        'location' => 'Surabaya, Indonesia',
                        'posted' => '4 Hari Yang Lalu',
                        'logo' => asset('images/mitra/wowrack.webp'),
                    ]
                ]
            ],
            'pt-garuda-telekomunikasi-indonesia-waru' => [
                'nama' => 'PT. Garuda Telekomunikasi Indonesia',
                'slug' => 'pt-garuda-telekomunikasi-indonesia-waru',
                'alamat' => 'Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',
                'deskripsi' => 'PT Javacreatiox Network Intermedia merupakan perusahaan yang bergerak di bidang teknologi informasi dengan layanan utama meliputi web development, instalasi CCTV, Internet of Things (IoT), serta IT support.',
                'website_url' => 'https://ptgaruda-telkomind.com',
                'website_label' => 'ptgaruda-telkomind.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/gt.webp'),
                'jobs' => []
            ],
            'pt-global-infra-teknologi-pabean' => [
                'nama' => 'PT. Global Infra Teknologi',
                'slug' => 'pt-global-infra-teknologi-pabean',
                'alamat' => 'Kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',
                'deskripsi' => 'PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi',
                'website_url' => 'https://globalinfratek.co.id',
                'website_label' => 'globalinfratek.co.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/gi.webp'),
                'jobs' => []
            ],
            'pt-radnet-digital-indonesia-kemenkomdigi' => [
                'nama' => 'PT. RADNET DIGITAL INDONESIA',
                'slug' => 'pt-radnet-digital-indonesia-kemenkomdigi',
                'alamat' => 'Kec. Genteng, Surabaya, Jawa Timur 60271',
                'deskripsi' => 'PT. RADNET DIGITAL INDONESIA (radneXt) adalah Internet Service Provider (ISP) resmi berlisensi Kementerian Komunikasi dan Informatika RI.',
                'website_url' => 'https://radnet.id',
                'website_label' => 'radnet.id',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/radnext.webp'),
                'jobs' => []
            ],
            'weza-group-pt-weza-punya-cerita' => [
                'nama' => 'Weza Group – PT Weza Punya Cerita',
                'slug' => 'weza-group-pt-weza-punya-cerita',
                'alamat' => 'Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61217',
                'deskripsi' => 'PT Weza Punya Cerita merupakan perusahaan teknologi yang berfokus pada penyediaan solusi B2B melalui layanan unggulannya, Weza Solutions.',
                'website_url' => 'https://wezagroup.com',
                'website_label' => 'wezagroup.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'logo' => asset('images/mitra/weza.webp'),
                'jobs' => [
                    [
                        'title' => 'B2B Solution Associate',
                        'company' => 'Weza Group',
                        'location' => 'Sidoarjo, Indonesia',
                        'posted' => '2 Hari Yang Lalu',
                        'logo' => asset('images/mitra/weza.webp'),
                    ]
                ]
            ],
        ];
    }

    /**
     * Menampilkan Katalog 13 Mitra Industri
     */
    public function index()
    {
        $mitras = array_values($this->getMitraDataset());
        $mitraDetail = null;

        return view('pages.mitra-industri', compact('mitras', 'mitraDetail'));
    }

    /**
     * Menampilkan Detail Mitra Industri Dinamis (Single View File)
     */
    public function show($slug)
    {
        $dataset = $this->getMitraDataset();
        $mitras = array_values($dataset);

        $mitraDetail = array_key_exists($slug, $dataset) ? $dataset[$slug] : reset($dataset);

        return view('pages.mitra-industri', compact('mitras', 'mitraDetail'));
    }
}