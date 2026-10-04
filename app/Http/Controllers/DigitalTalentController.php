<?php

namespace App\Http\Controllers;

class DigitalTalentController extends Controller
{
    /**
     * Menampilkan Katalog DTP & 9 Tab Filter (Desktop - 29.png)
     */
    public function index()
    {
        $dtpList = config('digital_talent');
        $activeDtp = $dtpList['software-developer'];
        $dtpDetail = null;

        return view('pages.digital-talent', compact('dtpList', 'activeDtp', 'dtpDetail'));
    }

    /**
     * Menampilkan Detail Peminatan DTP Dinamis (Desktop - 41.png)
     */
    public function show($slug)
    {
        $dtpList = config('digital_talent');

        if (! array_key_exists($slug, $dtpList)) {
            $slug = 'software-developer';
        }

        $dtpDetail = $dtpList[$slug];
        $activeDtp = null;

        return view('pages.digital-talent', compact('dtpList', 'activeDtp', 'dtpDetail'));
    }
}
