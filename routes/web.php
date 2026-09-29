<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\MitraIndustriController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PenerapanK3Controller;
use App\Http\Controllers\TrialClassController;
use App\Http\Controllers\JurufindController;

Route::view('/', 'home')->name('home');
Route::view('/jurufind', 'jurufind')->name('jurufind');
Route::view('/ppdb', 'ppdb')->name('ppdb');

Route::get('/tentang-kami/profile-sekolah', [ProfileSekolahController::class, 'index'])->name('profile-sekolah.index');
Route::get('/tentang-kami/hubungan-industri', [MitraIndustriController::class, 'index'])->name('mitra-industri.index');
Route::get('/tentang-kami/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/tentang-kami/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/tentang-kami/profil-guru', [GuruController::class, 'index'])->name('profil-guru.index');
Route::get('/informasi/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/informasi/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/informasi/penerapan-k3', [PenerapanK3Controller::class, 'index'])->name('penerapan-k3.index');
Route::get('/jurufind/test', [JurufindController::class, 'test'])->name('jurufind.test');
Route::post('/jurufind/analyze', [JurufindController::class, 'analyze'])
    ->middleware('throttle:20,1') // batasi 20 request/menit per IP, cegah spam ke AI provider
    ->name('jurufind.analyze');

// Rute Trial Class
Route::get('/informasi/trial-class', [TrialClassController::class, 'index'])->name('trial-class.index');