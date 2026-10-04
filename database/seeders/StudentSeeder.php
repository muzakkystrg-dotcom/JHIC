<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Seed data siswa untuk verifikasi SSO.
     */
    public function run(): void
    {
        $students = [
            [
                'sso' => '541211001',
                'name' => 'Ahmad Fauzi',
                'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
                'dtp' => '2023/2024',
            ],
            [
                'sso' => '541211002',
                'name' => 'Siti Aminah',
                'major' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
                'dtp' => '2023/2024',
            ],
            [
                'sso' => '541211003',
                'name' => 'Budi Santoso',
                'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
                'dtp' => '2022/2023',
            ],
            [
                'sso' => '541211004',
                'name' => 'Dewi Lestari',
                'major' => 'Teknik Jaringan Akses Telekomunikasi (TJAT)',
                'dtp' => '2022/2023',
            ],
            [
                'sso' => '541211005',
                'name' => 'Reza Pratama',
                'major' => 'Sistem Informasi Jaringan & Aplikasi (SIJA)',
                'dtp' => '2024/2025',
            ],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(
                ['sso' => $student['sso']],
                $student,
            );
        }
    }
}
