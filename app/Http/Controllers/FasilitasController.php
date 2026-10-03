<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Menampilkan Halaman Fasilitas SMK Telkom Sidoarjo.
     *
     * Catatan: data carousel fasilitas didefinisikan langsung di
     * resources/views/pages/fasilitas.blade.php ($allFacilities) dengan aset
     * WebP yang sudah dioptimasi. Array duplikat yang dulu ada di sini dihapus
     * agar tidak lagi menyisakan referensi gambar 404 (lab-ai.png, oc-besar.png,
     * dst.). Menyimpan data di view membuat satu sumber kebenaran saja.
     */
    public function index()
    {
        return view('pages.fasilitas');
    }
}