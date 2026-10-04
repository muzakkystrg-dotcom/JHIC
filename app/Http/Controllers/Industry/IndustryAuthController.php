<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustryAuthController extends Controller
{
    public function showLoginForm()
    {
        // Selalu tampilkan form login — walau sesi mitra masih aktif. Tanpa ini,
        // tombol "Industry Dashboard" di Career Center bisa terasa "tidak bisa
        // dibuka" karena pengunjung yang sudah login dilempar ke halaman lain.
        return view('pages.industry.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'industry_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'industry_id' => $request->industry_id,
            'password' => $request->password,
        ];

        if (Auth::guard('industry')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('industry.dashboard'));
        }

        return back()->withErrors([
            'industry_id' => 'ID Industri atau Password yang Anda masukkan tidak sesuai.',
        ])->withInput($request->only('industry_id'));
    }

    public function logout(Request $request)
    {
        Auth::guard('industry')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('industry.login');
    }
}
