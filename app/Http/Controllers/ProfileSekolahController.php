<?php

namespace App\Http\Controllers;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $visiMisi = config('profil_sekolah');

        return view('pages.profile-sekolah', compact('visiMisi'));
    }
}
