<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurufindController;
use App\Http\Controllers\MitraIndustriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfileSekolahController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/jurufind', 'jurufind')->name('jurufind');
Route::view('/ppdb', 'ppdb')->name('ppdb');

// Rute Profil Sekolah
Route::get('/tentang-kami/profile-sekolah', [ProfileSekolahController::class, 'index'])->name('profile-sekolah.index');

// Rute Mitra Industri
Route::get('/tentang-kami/hubungan-industri', [MitraIndustriController::class, 'index'])->name('mitra-industri.index');

// Rute Fasilitas
Route::get('/tentang-kami/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// Rute Prestasi
Route::get('/tentang-kami/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');

// Rute Profil Guru
Route::get('/tentang-kami/profil-guru', [GuruController::class, 'index'])->name('profil-guru.index');

Route::get('/jurufind/test', [JurufindController::class, 'test'])->name('jurufind.test');

Route::post('/jurufind/analyze', [JurufindController::class, 'analyze'])
    ->middleware('throttle:20,1') // batasi 20 request/menit per IP, cegah spam ke AI provider
    ->name('jurufind.analyze');
