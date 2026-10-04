<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Kategori diambil dinamis dari data berita yang sudah terbit.
        $categories = Berita::query()
            ->where('is_published', true)
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->prepend('Semua')
            ->values();

        $beritas = Berita::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->get();

        return view('pages.berita', compact('categories', 'beritas'));
    }
}
