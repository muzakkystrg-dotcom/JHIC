<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class JobVacancySeeder extends Seeder
{
    /**
     * Seed data lowongan kerja awal.
     *
     * Menggantikan data hardcoded di CareerCenterController & view career-center.
     * Data ini juga dipakai sebagai daftar lowongan per mitra industri.
     */
    public function run(): void
    {
        $vacancies = [
            [
                'title' => 'Junior DevOps',
                'company' => 'Pt. Garuda Telekomunikasi Indonesia',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/gt.webp',
                'description' => 'Mendukung otomatisasi deployment, monitoring, dan pengelolaan infrastruktur aplikasi.',
                'posted_at' => '2026-09-07 08:00:00',
            ],
            [
                'title' => 'Network Technician',
                'company' => 'Axelbit Solutions',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/axelbit.webp',
                'description' => 'Instalasi, konfigurasi, dan pemeliharaan perangkat jaringan pada sisi pelanggan.',
                'posted_at' => '2026-09-06 08:00:00',
            ],
            [
                'title' => 'Junior Web Developer',
                'company' => 'DigiPrener Tech',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/digi.webp',
                'description' => 'Mengembangkan dan memelihara aplikasi web menggunakan framework modern.',
                'posted_at' => '2026-09-07 08:00:00',
            ],
            [
                'title' => 'Cloud System Support',
                'company' => 'Jagoan Hosting Indonesia',
                'category' => 'Full Time',
                'location' => 'Malang, Indonesia',
                'logo' => 'images/mitra/jagoanhosting.webp',
                'description' => 'Memberikan dukungan teknis layanan cloud hosting kepada pelanggan.',
                'posted_at' => '2026-09-05 08:00:00',
            ],
            [
                'title' => 'Creative Graphic Designer',
                'company' => 'Markaz Design Studio',
                'category' => 'Full Time',
                'location' => 'Sidoarjo, Indonesia',
                'logo' => 'images/mitra/markaz.webp',
                'description' => 'Merancang aset visual branding dan materi desain untuk klien UMKM.',
                'posted_at' => '2026-09-07 08:00:00',
            ],
            [
                'title' => 'Fullstack Developer Trainee',
                'company' => 'PT Javacreatiox Network',
                'category' => 'Internship',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/javacreat.webp',
                'description' => 'Program pelatihan pengembangan aplikasi web end-to-end untuk pemula.',
                'posted_at' => '2026-09-06 08:00:00',
            ],
            [
                'title' => 'Technical Support NOC',
                'company' => 'PT Radnet Digital Indonesia',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/radnext.webp',
                'description' => 'Memantau dan menangani gangguan jaringan pada Network Operations Center.',
                'posted_at' => '2026-09-07 08:00:00',
            ],
            [
                'title' => 'Data Center Technician',
                'company' => 'Wowrack Indonesia',
                'category' => 'Full Time',
                'location' => 'Surabaya, Indonesia',
                'logo' => 'images/mitra/wowrack.webp',
                'description' => 'Perawatan perangkat dan infrastruktur fisik data center.',
                'posted_at' => '2026-09-04 08:00:00',
            ],
            [
                'title' => 'B2B Solution Associate',
                'company' => 'Weza Group',
                'category' => 'Full Time',
                'location' => 'Sidoarjo, Indonesia',
                'logo' => 'images/mitra/weza.webp',
                'description' => 'Mendukung penyusunan solusi teknologi B2B untuk klien korporasi.',
                'posted_at' => '2026-09-06 08:00:00',
            ],
        ];

        foreach ($vacancies as $vacancy) {
            JobVacancy::updateOrCreate(
                ['slug' => Str::slug($vacancy['title'].'-'.$vacancy['company'])],
                [
                    'title' => $vacancy['title'],
                    'company' => $vacancy['company'],
                    'category' => $vacancy['category'],
                    'location' => $vacancy['location'],
                    'description' => $vacancy['description'],
                    'logo' => $vacancy['logo'],
                    'posted_at' => Carbon::parse($vacancy['posted_at']),
                    'is_active' => true,
                ],
            );
        }
    }
}
