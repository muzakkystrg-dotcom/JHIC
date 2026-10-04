<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Seed data berita awal.
     *
     * Menggantikan data hardcoded di BeritaController (10 item identik).
     * Silakan ubah/tambah lewat admin atau langsung di sini.
     */
    public function run(): void
    {
        $beritas = [
            [
                'title' => 'Lomba Matematika SMP/MTs Terbesar Se-Sidoarjo Sukses Digelar di SKOMDA',
                'category' => 'Kegiatan Sekolah',
                'excerpt' => 'Ratusan siswa SMP/MTs se-Sidoarjo berkompetisi dalam lomba matematika yang digelar di SMK Telkom Sidoarjo.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2025-11-27 19:24:35',
            ],
            [
                'title' => 'Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026',
                'category' => 'Prestasi',
                'excerpt' => 'Siswa SIJA berhasil meraih juara 1 lomba web design tingkat Provinsi Jawa Timur.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-06-05 10:00:00',
            ],
            [
                'title' => 'Penandatanganan Kerja Sama dengan Mitra Industri Telekomunikasi',
                'category' => 'Kemitraan & Kerja Sama',
                'excerpt' => 'SMK Telkom Sidoarjo memperluas jejaring kemitraan industri untuk magang dan rekrutmen alumni.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-06-01 09:30:00',
            ],
            [
                'title' => 'Karya Inovasi Siswa: Smart Home Automation Berbasis IoT',
                'category' => 'Karya & Inovasi Siswa',
                'excerpt' => 'Tim siswa memamerkan proyek smart home berbasis IoT dalam pameran inovasi sekolah.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-05-20 14:15:00',
            ],
            [
                'title' => 'Pengumuman: Jadwal Ujian Tengah Semester Genap',
                'category' => 'Pengumuman',
                'excerpt' => 'Berikut jadwal dan tata tertib ujian tengah semester genap tahun ajaran berjalan.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-03-10 08:00:00',
            ],
            [
                'title' => 'Tips Belajar Efektif untuk Siswa SMK Bidang Teknologi',
                'category' => 'Artikel & edukasi',
                'excerpt' => 'Strategi belajar yang efektif bagi siswa SMK yang fokus pada kompetensi teknologi dan praktik industri.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-02-18 11:45:00',
            ],
            [
                'title' => 'Kisah Alumni: Dari SMK Telkom Sidoarjo ke Industri Cloud',
                'category' => 'Alumni',
                'excerpt' => 'Alumni berbagi pengalaman meniti karier di bidang cloud computing setelah lulus dari SMK Telkom Sidoarjo.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2026-01-25 16:20:00',
            ],
            [
                'title' => 'Kegiatan Class Meeting Akhir Semester Penuh Semangat',
                'category' => 'Kegiatan Sekolah',
                'excerpt' => 'Berbagai pertandingan dan kegiatan class meeting berlangsung meriah di akhir semester.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2025-12-15 13:00:00',
            ],
            [
                'title' => 'Medali Emas Olimpiade Jaringan Komputer Tingkat Nasional',
                'category' => 'Prestasi',
                'excerpt' => 'Siswa TJAT meraih medali emas pada olimpiade jaringan komputer tingkat nasional.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2025-11-02 09:10:00',
            ],
            [
                'title' => 'Sosialisasi K3 untuk Praktik Laboratorium Jaringan dan Fiber Optik',
                'category' => 'Pengumuman',
                'excerpt' => 'Sekolah menggelar sosialisasi penerapan Keselamatan dan Kesehatan Kerja (K3) di laboratorium.',
                'thumbnail' => 'images/berita/juara.webp',
                'published_at' => '2025-10-21 10:40:00',
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($berita['title'])],
                [
                    'title' => $berita['title'],
                    'category' => $berita['category'],
                    'excerpt' => $berita['excerpt'],
                    'content' => $berita['excerpt'],
                    'thumbnail' => $berita['thumbnail'],
                    'published_at' => Carbon::parse($berita['published_at']),
                    'is_published' => true,
                ],
            );
        }
    }
}
