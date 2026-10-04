<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filter pencarian berdasarkan Nama atau SSO.
        $alumnis = Alumni::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', '%'.$search.'%')
                        ->orWhere('sso', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('nama_siswa')
            ->get();

        return view('pages.alumni', compact('alumnis', 'search'));
    }
}
