<?php

namespace Database\Seeders;

use App\Models\PenerapanK3;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PenerapanK3Seeder extends Seeder
{
    /**
     * Seed dokumen K3 awal (dari data hardcoded PenerapanK3Controller).
     */
    public function run(): void
    {
        $dokumens = [
            [
                'nama_file' => 'SOP Keselamatan Praktikum Lab Komputer & Jaringan.pdf',
                'file_size' => '2.4 MB',
                'uploaded_at' => '2025-01-12',
            ],
            [
                'nama_file' => 'Manual K3 Workshop Fiber Optik & Telekomunikasi.pdf',
                'file_size' => '3.1 MB',
                'uploaded_at' => '2025-01-15',
            ],
            [
                'nama_file' => 'Prosedur Darurat & Evakuasi Kebakaran Gedung Sekolah.pdf',
                'file_size' => '1.8 MB',
                'uploaded_at' => '2025-01-20',
            ],
            [
                'nama_file' => 'Pedoman Penggunaan Alat Pelindung Diri (APD) Siswa.pdf',
                'file_size' => '4.0 MB',
                'uploaded_at' => '2025-01-25',
            ],
        ];

        foreach ($dokumens as $dokumen) {
            PenerapanK3::updateOrCreate(
                ['slug' => Str::slug(Str::replaceLast('.pdf', '', $dokumen['nama_file']))],
                [
                    'nama_file' => $dokumen['nama_file'],
                    'file_size' => $dokumen['file_size'],
                    'uploaded_at' => Carbon::parse($dokumen['uploaded_at']),
                ],
            );
        }
    }
}
