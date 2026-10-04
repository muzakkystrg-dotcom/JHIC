<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CareerCenterController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DigitalTalentController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Industry\IndustryApplicantController;
use App\Http\Controllers\Industry\IndustryAuthController;
use App\Http\Controllers\Industry\IndustryCompanyProfileController;
use App\Http\Controllers\Industry\IndustryDashboardController;
use App\Http\Controllers\Industry\IndustryJobController;
use App\Http\Controllers\JurufindController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MitraIndustriController;
use App\Http\Controllers\PenerapanK3Controller;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\ProgramCCPController;
use App\Http\Controllers\ProgramTS21Controller;
use App\Http\Controllers\SilabusController;
use App\Http\Controllers\TrialClassController;
use Illuminate\Support\Facades\Route;

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
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])
    ->middleware('throttle:15,1') // lebih ketat dari Jurufind karena multi-turn gampang di-spam
    ->name('chatbot.ask');

Route::get('/jurufind/test', [JurufindController::class, 'test'])->name('jurufind.test');
Route::get('/jurufind/hasil', [JurufindController::class, 'result'])->name('jurufind.result');
Route::post('/jurufind/analyze', [JurufindController::class, 'analyze'])
    ->middleware('throttle:60,1')
    ->name('jurufind.analyze');

// --- FITUR CAREER CENTER, SSO FORM & REGISTRATION FORM ---
Route::get('/career-center', [CareerCenterController::class, 'index'])->name('career-center.index');
Route::get('/career-center/sso-verification', [CareerCenterController::class, 'ssoForm'])->name('career-center.sso');
Route::post('/career-center/sso-check', [CareerCenterController::class, 'checkSso'])
    ->middleware('throttle:60,1')
    ->name('career-center.sso.check');
Route::get('/career-center/register', [CareerCenterController::class, 'registerForm'])->name('career-center.register');
Route::post('/career-center/register', [CareerCenterController::class, 'submitRegistration'])
    ->middleware('throttle:60,1')
    ->name('career-center.register.submit');
Route::get('/career-center/apply-success', [CareerCenterController::class, 'applySuccess'])->name('career-center.success');

// --- PROGRAM JURUSAN, DTP, CCP & EKSTRAKURIKULER ---
Route::get('/jurusan/sija', [JurusanController::class, 'sija'])->name('jurusan.sija');
Route::get('/jurusan/tjat', [JurusanController::class, 'tjat'])->name('jurusan.tjat');
// Redirect alias memakai Route::redirect() (bukan closure) agar `php artisan route:cache` bisa jalan.
Route::redirect('/program/jurusan', '/jurusan/sija')->name('jurusan.index');
Route::get('/program/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
Route::get('/program/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
Route::get('/program/digital-talent-program', [DigitalTalentController::class, 'index'])->name('digital-talent.index');
Route::get('/program/digital-talent-program/{slug}', [DigitalTalentController::class, 'show'])->name('digital-talent.show');
Route::redirect('/program/dtp', '/program/digital-talent-program');
Route::get('/program/program-ccp', [ProgramCCPController::class, 'index'])->name('program-ccp.index');
Route::redirect('/program/ccp', '/program/program-ccp');

// ==========================================
// RUTE PROGRAM: PROGRAM TS21
// ==========================================
Route::get('/program/program-ts21', [ProgramTS21Controller::class, 'index'])->name('program-ts21.index');
Route::redirect('/program/ts21', '/program/program-ts21');

// --- SILABUS PEMBELAJARAN ---
Route::get('/jurusan/sija/silabus', [SilabusController::class, 'sija'])->name('silabus.sija');
Route::get('/jurusan/tjat/silabus', [SilabusController::class, 'tjat'])->name('silabus.tjat');
Route::get('/jurusan/{jurusan}/silabus', [SilabusController::class, 'show'])->name('silabus.show');

/*
|--------------------------------------------------------------------------
| Web Routes - Portal Mitra Industri (Industry Dashboard)
|--------------------------------------------------------------------------
| Guard: `industry` (provider: industries). Prefix URL & nama route `industry.`
| agar tidak bertabrakan dengan route publik JHIC di atas.
| Entry point tombol "Industry Dashboard" di halaman Career Center.
*/

// Autentikasi Mitra Industri
// SENGAJA tanpa middleware `guest:industry`: halaman login harus SELALU bisa
// dibuka. Kalau pakai `guest`, mitra yang sesinya masih aktif akan dilempar ke
// route default (`home`/beranda) saat menekan tombol "Industry Dashboard" di
// Career Center — halaman login jadi seperti "tidak bisa dibuka".
Route::get('/industry/login', [IndustryAuthController::class, 'showLoginForm'])->name('industry.login');
Route::post('/industry/login', [IndustryAuthController::class, 'login'])->name('industry.login.submit');

Route::post('/industry/logout', [IndustryAuthController::class, 'logout'])
    ->middleware('auth:industry')
    ->name('industry.logout');

// Halaman terproteksi (login mitra industri dulu)
Route::middleware('auth:industry')->prefix('industry')->name('industry.')->group(function () {
    Route::get('/dashboard', [IndustryDashboardController::class, 'index'])->name('dashboard');

    Route::get('/jobs', [IndustryJobController::class, 'index'])->name('jobs.index');
    Route::post('/jobs', [IndustryJobController::class, 'store'])->name('jobs.store');
    Route::delete('/jobs/{id}', [IndustryJobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/applicants', [IndustryApplicantController::class, 'index'])->name('applicants.index');
    Route::get('/applicants/{id}', [IndustryApplicantController::class, 'show'])->name('applicants.show');
    Route::get('/applicants/{id}/files/{type}', [IndustryApplicantController::class, 'downloadFile'])
        ->whereIn('type', ['cv', 'portfolio'])
        ->name('applicants.file');
    Route::post('/applicants/{id}/status', [IndustryApplicantController::class, 'updateStatus'])->name('applicants.updateStatus');

    Route::get('/company-profile', [IndustryCompanyProfileController::class, 'index'])->name('profile.index');
});
