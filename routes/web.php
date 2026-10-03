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
use App\Http\Controllers\CareerCenterController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\SilabusController;
use App\Http\Controllers\DigitalTalentController;
use App\Http\Controllers\ProgramCCPController;
use App\Http\Controllers\ProgramTS21Controller;

/*
|--------------------------------------------------------------------------
| Web Routes - SMK Telkom Sidoarjo (JHIC Portal)
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');
Route::view('/jurufind', 'jurufind')->name('jurufind');
Route::view('/ppdb', 'ppdb')->name('ppdb');

// --- TENTANG KAMI & HUBUNGAN INDUSTRI ---
Route::get('/tentang-kami/profile-sekolah', [ProfileSekolahController::class, 'index'])->name('profile-sekolah.index');
Route::get('/tentang-kami/hubungan-industri', [MitraIndustriController::class, 'index'])->name('mitra-industri.index');
Route::get('/tentang-kami/hubungan-industri/{slug}', [MitraIndustriController::class, 'show'])->name('mitra-industri.show');
Route::get('/tentang-kami/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/tentang-kami/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/tentang-kami/profil-guru', [GuruController::class, 'index'])->name('profil-guru.index');
Route::get('/tentang-kami/profil-guru/{slug}', [GuruController::class, 'show'])->name('profil-guru.show');

// --- INFORMASI ---
Route::get('/informasi/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/informasi/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/informasi/penerapan-k3', [PenerapanK3Controller::class, 'index'])->name('penerapan-k3.index');
Route::get('/informasi/trial-class', [TrialClassController::class, 'index'])->name('trial-class.index');

// --- JURUFIND AI ---
Route::get('/jurufind/test', [JurufindController::class, 'test'])->name('jurufind.test');
Route::post('/jurufind/analyze', [JurufindController::class, 'analyze'])
    ->middleware('throttle:20,1')
    ->name('jurufind.analyze');

// --- FITUR CAREER CENTER, SSO FORM & REGISTRATION FORM ---
Route::get('/career-center', [CareerCenterController::class, 'index'])->name('career-center.index');
Route::get('/career-center/sso-verification', [CareerCenterController::class, 'ssoForm'])->name('career-center.sso');
Route::post('/career-center/sso-check', [CareerCenterController::class, 'checkSso'])
    ->middleware('throttle:10,1')
    ->name('career-center.sso.check');
Route::get('/career-center/register', [CareerCenterController::class, 'registerForm'])->name('career-center.register');
Route::post('/career-center/register', [CareerCenterController::class, 'submitRegistration'])
    ->middleware('throttle:5,10')
    ->name('career-center.register.submit');
Route::get('/career-center/apply-success', [CareerCenterController::class, 'applySuccess'])->name('career-center.success');

// --- PROGRAM JURUSAN, DTP, CCP & EKSTRAKURIKULER ---
Route::get('/jurusan/sija', [JurusanController::class, 'sija'])->name('jurusan.sija');
Route::get('/jurusan/tjat', [JurusanController::class, 'tjat'])->name('jurusan.tjat');
Route::get('/program/jurusan', fn() => redirect()->route('jurusan.sija'))->name('jurusan.index');
Route::get('/program/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
Route::get('/program/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
Route::get('/program/digital-talent-program', [DigitalTalentController::class, 'index'])->name('digital-talent.index');
Route::get('/program/digital-talent-program/{slug}', [DigitalTalentController::class, 'show'])->name('digital-talent.show');
Route::get('/program/dtp', fn() => redirect()->route('digital-talent.index'));
Route::get('/program/program-ccp', [ProgramCCPController::class, 'index'])->name('program-ccp.index');
Route::get('/program/ccp', fn() => redirect()->route('program-ccp.index'));

// ==========================================
// RUTE PROGRAM: PROGRAM TS21
// ==========================================
Route::get('/program/program-ts21', [ProgramTS21Controller::class, 'index'])->name('program-ts21.index');
Route::get('/program/ts21', fn() => redirect()->route('program-ts21.index'));

// --- SILABUS PEMBELAJARAN ---
Route::get('/jurusan/sija/silabus', [SilabusController::class, 'sija'])->name('silabus.sija');
Route::get('/jurusan/tjat/silabus', [SilabusController::class, 'tjat'])->name('silabus.tjat');
Route::get('/jurusan/{jurusan}/silabus', [SilabusController::class, 'show'])->name('silabus.show');