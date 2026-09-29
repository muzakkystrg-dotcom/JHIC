<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Data Kepala Sekolah
        $kepalaSekolah = [
            'nama' => 'Abror S.Hum M.Pd',
            'jabatan' => 'Kepala Sekolah',
            'pendidikan' => '-',
            'keahlian' => 'Bimbingan Konseling',
            'motto' => 'Belajar bukan sekadar mencari nilai, tapi membangun masa depan',
            'email' => 'abror@smktelkom-sda.sch.id',
            'deskripsi' => 'Guru yang berfokus pada pengembangan karakter dan keterampilan digital siswa, khususnya di bidang jaringan komputer dan teknologi informasi.',
            'foto' => asset('images/guru/kepala-sekolah.png') // Sesuai foto duduk santai kemeja navy
        ];

        // Data Wakil Kepala Bidang (4 Orang)
        $wakaBidang = [
            ['nama' => 'Waka 1', 'jabatan' => 'Wakil Kepala Bidang Kurikulum', 'foto' => asset('images/guru/waka-1.png')],
            ['nama' => 'Waka 2', 'jabatan' => 'Wakil Kepala Bidang Kesiswaan', 'foto' => asset('images/guru/waka-2.png')],
            ['nama' => 'Waka 3', 'jabatan' => 'Wakil Kepala Bidang Hubungan Industri', 'foto' => asset('images/guru/waka-3.png')],
            ['nama' => 'Waka 4', 'jabatan' => 'Wakil Kepala Bidang Sarana & Prasarana', 'foto' => asset('images/guru/waka-4.png')],
        ];

        // Data Guru Produktif dan Non Produktif (8 Orang)
        $guruMapel = [
            ['nama' => 'Guru 1', 'mapel' => 'Produktif SIJA', 'foto' => asset('images/guru/guru-1.png')],
            ['nama' => 'Guru 2', 'mapel' => 'Produktif TJAT', 'foto' => asset('images/guru/guru-2.png')],
            ['nama' => 'Guru 3', 'mapel' => 'Matematika', 'foto' => asset('images/guru/guru-3.png')],
            ['nama' => 'Guru 4', 'mapel' => 'Bahasa Inggris', 'foto' => asset('images/guru/guru-4.png')],
            ['nama' => 'Guru 5', 'mapel' => 'Informatika', 'foto' => asset('images/guru/guru-5.png')],
            ['nama' => 'Guru 6', 'mapel' => 'PPKn', 'foto' => asset('images/guru/guru-6.png')],
            ['nama' => 'Guru 7', 'mapel' => 'Sejarah Indonesia', 'foto' => asset('images/guru/guru-7.png')],
            ['nama' => 'Guru 8', 'mapel' => 'Seni Budaya', 'foto' => asset('images/guru/guru-8.png')],
        ];

        return view('pages.profil-guru', compact('kepalaSekolah', 'wakaBidang', 'guruMapel'));
    }
}