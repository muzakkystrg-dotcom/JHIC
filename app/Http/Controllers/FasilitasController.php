<?php

namespace App\Http\Controllers;

class FasilitasController extends Controller
{
    /**
     * Menampilkan Halaman Fasilitas SMK Telkom Sidoarjo.
     *
     * Data carousel fasilitas kini disimpan di config/fasilitas.php agar
     * controller bersih dan hanya ada satu sumber kebenaran.
     */
    public function index()
    {
        $allFacilities = config('fasilitas', []);

        return view('pages.fasilitas', compact('allFacilities'));
    }
}
