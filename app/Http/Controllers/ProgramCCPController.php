<?php

namespace App\Http\Controllers;

class ProgramCCPController extends Controller
{
    /**
     * Menampilkan Halaman Program CCP (Desktop - 30.png)
     */
    public function index()
    {
        $ccpData = config('program.ccp');
        $ccpData['hero']['image'] = asset($ccpData['hero']['image']);

        return view('pages.program-ccp', compact('ccpData'));
    }
}
