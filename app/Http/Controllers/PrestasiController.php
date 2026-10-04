<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        $achievements = Prestasi::query()
            ->orderBy('id')
            ->get();

        // Grafik prestasi dihitung dinamis dari kolom `level`.
        $levels = ['Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];
        $chartData = [
            'labels' => $levels,
            'data' => array_map(
                fn ($level) => Prestasi::where('level', $level)->count(),
                $levels
            ),
        ];

        return view('pages.prestasi', compact('chartData', 'achievements'));
    }
}
