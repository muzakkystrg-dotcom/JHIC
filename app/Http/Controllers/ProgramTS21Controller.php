<?php

namespace App\Http\Controllers;

class ProgramTS21Controller extends Controller
{
    /**
     * Menampilkan Halaman Program TS21 (Desktop - 31.png)
     */
    public function index()
    {
        $ts21Data = config('program.ts21');
        $ts21Data['hero']['image'] = asset($ts21Data['hero']['image']);

        return view('pages.program-ts21', compact('ts21Data'));
    }
}
