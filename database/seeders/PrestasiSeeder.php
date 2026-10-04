<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    /**
     * Seed data prestasi awal (dari data hardcoded PrestasiController).
     */
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Para Juara - Generative AI Web Design',
                'category' => '🖥️🏆 Skill digital, naik level!',
                'level' => 'Nasional',
                'description' => 'Tiga siswa SKOMDA berhasil membawa pulang prestasi dari Intermedia Information Technology Competition (IITC) 2026 yang diselenggarakan Universitas Amikom Purwokerto. 🚀',
                'image' => 'images/prestasi/juara.webp',
            ],
            [
                'title' => 'Juara 1 LKS Web Technologies Tingkat Nasional',
                'category' => '💻🥇 Kompetensi keahlian unggul',
                'level' => 'Nasional',
                'description' => 'Siswa jurusan SIJA sukses mendominasi ajang LKS Nasional melalui inovasi web application development berstandar industri.',
                'image' => 'images/prestasi/juara.webp',
            ],
            [
                'title' => 'Medali Emas Olimpiade Jaringan Komputer',
                'category' => '🌐🏅 Networking champion',
                'level' => 'Provinsi',
                'description' => 'Prestasi membanggakan di bidang infrastruktur jaringan telekomunikasi dan konfigurasi router tingkat regional.',
                'image' => 'images/prestasi/juara.webp',
            ],
        ];

        foreach ($achievements as $achievement) {
            Prestasi::updateOrCreate(
                ['slug' => Str::slug($achievement['title'])],
                $achievement,
            );
        }
    }
}
