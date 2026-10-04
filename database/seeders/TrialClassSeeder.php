<?php

namespace Database\Seeders;

use App\Models\TrialClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TrialClassSeeder extends Seeder
{
    /**
     * Seed jadwal trial class awal (dari data hardcoded TrialClassController).
     */
    public function run(): void
    {
        $classes = [
            [
                'judul' => 'Eksplorasi Jaringan Fiber Optik & 5G',
                'jurusan' => 'TJAT',
                'tanggal' => '2026-02-10',
                'jam' => '09:00 - 11:30 WIB',
                'instruktur' => 'Tim Lab Telekomunikasi',
                'kuota' => 25,
            ],
            [
                'judul' => 'Pemrograman Web & UI/UX Design Dasar',
                'jurusan' => 'SIJA',
                'tanggal' => '2026-02-12',
                'jam' => '13:00 - 15:30 WIB',
                'instruktur' => 'Tim Produktif SIJA',
                'kuota' => 25,
            ],
            [
                'judul' => 'Smart Home Automation berbasis IoT',
                'jurusan' => 'SIJA / TJAT',
                'tanggal' => '2026-02-15',
                'jam' => '09:00 - 11:30 WIB',
                'instruktur' => 'Tim IoT Lab RPS Hall',
                'kuota' => 20,
            ],
        ];

        foreach ($classes as $class) {
            TrialClass::updateOrCreate(
                ['slug' => Str::slug($class['judul'])],
                [
                    'judul' => $class['judul'],
                    'jurusan' => $class['jurusan'],
                    'tanggal' => Carbon::parse($class['tanggal']),
                    'jam' => $class['jam'],
                    'instruktur' => $class['instruktur'],
                    'kuota' => $class['kuota'],
                    'is_active' => true,
                ],
            );
        }
    }
}
