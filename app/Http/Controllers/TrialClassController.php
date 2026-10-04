<?php

namespace App\Http\Controllers;

use App\Models\TrialClass;
use Illuminate\Http\Request;

class TrialClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filter pencarian berdasarkan judul atau jurusan.
        $classes = TrialClass::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', '%'.$search.'%')
                        ->orWhere('jurusan', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('tanggal')
            ->get();

        return view('pages.trial-class', compact('classes', 'search'));
    }
}
