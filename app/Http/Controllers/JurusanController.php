<?php

namespace App\Http\Controllers;

class JurusanController extends Controller
{
    /**
     * Menampilkan Halaman Jurusan SIJA (Desktop - 26)
     */
    public function sija()
    {
        $data = config('jurusan.sija');
        $subjects = $data['subjects'];
        $works = $this->withAsset($data['works']);

        return view('pages.sija', compact('subjects', 'works'));
    }

    /**
     * Menampilkan Halaman Jurusan TJAT (Desktop - 28)
     */
    public function tjat()
    {
        $data = config('jurusan.tjat');
        $subjects = $data['subjects'];
        $works = $this->withAsset($data['works']);

        return view('pages.tjat', compact('subjects', 'works'));
    }

    /**
     * Terapkan asset() pada path gambar daftar karya.
     */
    private function withAsset(array $works): array
    {
        return array_map(function (array $work) {
            $work['image'] = asset($work['image']);

            return $work;
        }, $works);
    }
}
