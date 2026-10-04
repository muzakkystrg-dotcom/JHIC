<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Seed data alumni awal (dari data hardcoded AlumniController).
     */
    public function run(): void
    {
        $alumnis = [
            ['nama_siswa' => 'Ahmad Fauzi', 'jurusan' => 'SIJA', 'dtp' => 'Software Developer', 'sso' => '541211001'],
            ['nama_siswa' => 'Siti Aminah', 'jurusan' => 'TJAT', 'dtp' => 'CyberSecurity', 'sso' => '541211002'],
            ['nama_siswa' => 'Budi Santoso', 'jurusan' => 'SIJA', 'dtp' => 'AI Specialist', 'sso' => '541211003'],
            ['nama_siswa' => 'Dewi Lestari', 'jurusan' => 'TJAT', 'dtp' => 'Cloud Engineer', 'sso' => '541211004'],
            ['nama_siswa' => 'Reza Pratama', 'jurusan' => 'SIJA', 'dtp' => 'IOT', 'sso' => '541211005'],
        ];

        foreach ($alumnis as $alumni) {
            Alumni::updateOrCreate(
                ['sso' => $alumni['sso']],
                [
                    'nama_siswa' => $alumni['nama_siswa'],
                    'jurusan' => $alumni['jurusan'],
                    'dtp' => $alumni['dtp'],
                ],
            );
        }
    }
}
