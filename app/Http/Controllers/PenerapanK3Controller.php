<?php

namespace App\Http\Controllers;

use App\Models\PenerapanK3;

class PenerapanK3Controller extends Controller
{
    public function index()
    {
        $dokumens = PenerapanK3::query()
            ->orderBy('uploaded_at')
            ->get();

        return view('pages.penerapan-k3', compact('dokumens'));
    }
}
