<?php

namespace App\Http\Controllers;

class SilabusController extends Controller
{
    /**
     * Dataset silabus dari config, dengan asset() pada path gambar.
     */
    private function getSilabusDataset(): array
    {
        $dataset = config('silabus', []);

        foreach ($dataset as $key => $silabus) {
            $dataset[$key]['hero_image'] = $silabus['hero_image']
                ? asset($silabus['hero_image'])
                : null;
        }

        return $dataset;
    }

    /**
     * Halaman Silabus SIJA
     */
    public function sija()
    {
        $silabus = $this->getSilabusDataset()['sija'];

        return view('pages.silabus', compact('silabus'));
    }

    /**
     * Halaman Silabus TJAT
     */
    public function tjat()
    {
        $silabus = $this->getSilabusDataset()['tjat'];

        return view('pages.silabus', compact('silabus'));
    }

    /**
     * Handler Dinamis /jurusan/{jurusan}/silabus
     */
    public function show($jurusan)
    {
        $dataset = $this->getSilabusDataset();
        $key = strtolower($jurusan);
        $silabus = $dataset[$key] ?? $dataset['sija'];

        return view('pages.silabus', compact('silabus'));
    }
}
