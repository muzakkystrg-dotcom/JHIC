<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class GuruController extends Controller
{
    /**
     * Dataset guru dari config, dengan asset() pada path foto.
     */
    private function getGuruDataset(): array
    {
        $data = config('guru', []);

        $data['kepala_sekolah']['foto'] = asset($data['kepala_sekolah']['foto']);

        foreach (['waka_bidang', 'guru_mapel', 'staff_karyawan'] as $group) {
            $data[$group] = array_map(function (array $item) {
                $item['foto'] = asset($item['foto']);

                return $item;
            }, $data[$group] ?? []);
        }

        return $data;
    }

    /**
     * Menampilkan Katalog Profil Guru (Desktop - 23(1).png)
     */
    public function index()
    {
        $data = $this->getGuruDataset();

        return view('pages.profil-guru', [
            'kepalaSekolah' => $data['kepala_sekolah'],
            'wakaBidang' => $data['waka_bidang'],    // Pas 8 Card
            'guruMapel' => $data['guru_mapel'],     // Pas 29 Card
            'staffKaryawan' => $data['staff_karyawan'], // Pas 6 Card
            'guruDetail' => null,
        ]);
    }

    /**
     * Menampilkan Detail Guru Dinamis (Desktop - 42.png)
     */
    public function show($slug)
    {
        $data = $this->getGuruDataset();

        // Gabungkan seluruh orang untuk pencarian detail
        $all = collect([$data['kepala_sekolah']])
            ->merge($data['waka_bidang'])
            ->merge($data['guru_mapel'])
            ->merge($data['staff_karyawan']);

        $guruDetail = $all->first(function ($item) use ($slug) {
            return ($item['slug'] ?? Str::slug($item['nama'])) === $slug;
        });

        if (! $guruDetail) {
            $guruDetail = $data['waka_bidang'][0]; // Fallback ke Rachel Apriliani
        }

        return view('pages.profil-guru', [
            'kepalaSekolah' => null,
            'wakaBidang' => [],
            'guruMapel' => [],
            'staffKaryawan' => [],
            'guruDetail' => $guruDetail,
        ]);
    }
}
