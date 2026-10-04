<?php

namespace App\Http\Controllers;

class EkstrakurikulerController extends Controller
{
    /**
     * Dataset detail ekstrakurikuler dari config, dengan asset() pada gambar.
     */
    private function getEkstraDataset(): array
    {
        $details = config('ekskul.details', []);

        foreach ($details as $slug => $detail) {
            $details[$slug]['hero_image'] = asset($detail['hero_image']);
            $details[$slug]['gallery'] = array_map(function (array $item) {
                $item['image'] = asset($item['image']);

                return $item;
            }, $detail['gallery'] ?? []);
        }

        return $details;
    }

    /**
     * Daftar kartu ekstrakurikuler (index), dengan asset() pada gambar.
     */
    private function getEkstraList(): array
    {
        return array_map(function (array $item) {
            $item['image'] = asset($item['image']);

            return $item;
        }, config('ekskul.list', []));
    }

    /**
     * Menampilkan Katalog Ekstrakurikuler (Desktop - 27)
     */
    public function index()
    {
        $ekstras = $this->getEkstraList();

        $ekstraDetail = null;
        $prevSlug = null;
        $nextSlug = null;

        return view('pages.ekstrakurikuler', compact('ekstras', 'ekstraDetail', 'prevSlug', 'nextSlug'));
    }

    /**
     * Menampilkan Halaman Detail Ekstrakurikuler Dinamis (Desktop - 40)
     */
    public function show($slug)
    {
        $dataset = $this->getEkstraDataset();
        $slugKeys = array_keys($dataset);

        if (! array_key_exists($slug, $dataset)) {
            $slug = 'paskibraka';
        }

        $ekstraDetail = $dataset[$slug];

        // Navigasi Prev & Next melingkar
        $currentIndex = array_search($slug, $slugKeys);
        $prevIndex = ($currentIndex - 1 + count($slugKeys)) % count($slugKeys);
        $nextIndex = ($currentIndex + 1) % count($slugKeys);

        $prevSlug = $slugKeys[$prevIndex];
        $nextSlug = $slugKeys[$nextIndex];

        $ekstras = [];

        return view('pages.ekstrakurikuler', compact('ekstras', 'ekstraDetail', 'prevSlug', 'nextSlug'));
    }
}
