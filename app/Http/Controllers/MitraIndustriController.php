<?php

namespace App\Http\Controllers;

class MitraIndustriController extends Controller
{
    /**
     * Ambil dataset mitra dari config lalu terapkan asset() pada path gambar.
     */
    private function getMitraDataset(): array
    {
        $dataset = config('mitra', []);

        foreach ($dataset as $slug => $mitra) {
            $dataset[$slug]['logo'] = asset($mitra['logo']);
            $dataset[$slug]['jobs'] = array_map(function (array $job) {
                $job['logo'] = asset($job['logo']);

                return $job;
            }, $mitra['jobs'] ?? []);
        }

        return $dataset;
    }

    /**
     * Menampilkan Katalog 13 Mitra Industri
     */
    public function index()
    {
        $mitras = array_values($this->getMitraDataset());
        $mitraDetail = null;

        return view('pages.mitra-industri', compact('mitras', 'mitraDetail'));
    }

    /**
     * Menampilkan Detail Mitra Industri Dinamis (Single View File)
     */
    public function show($slug)
    {
        $dataset = $this->getMitraDataset();
        $mitras = array_values($dataset);

        $mitraDetail = array_key_exists($slug, $dataset) ? $dataset[$slug] : reset($dataset);

        return view('pages.mitra-industri', compact('mitras', 'mitraDetail'));
    }
}
