<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // 1. Data Kepala Sekolah
        $kepalaSekolah = [
            'nama' => 'Abror S.Hum M.Pd',
            'jabatan' => 'Kepala Sekolah',
            'pendidikan' => '-',
            'keahlian' => 'Bimbingan Konseling',
            'motto' => 'Belajar bukan sekadar mencari nilai, tapi membangun masa depan',
            'email' => 'abror@smktelkom-sda.sch.id',
            'deskripsi' => 'Guru yang berfokus pada pengembangan karakter dan keterampilan digital siswa, khususnya di bidang jaringan komputer dan teknologi informasi.',
            'foto' => asset('images/profileguru/pabror.png')
        ];

        // 2. Data Wakil Kepala Bidang
        $wakaBidang = [
            ['nama' => 'Waka 1', 'jabatan' => 'Wakil Kepala Bidang Kurikulum', 'foto' => asset('images/profileguru/arga.png')],
            ['nama' => 'Waka 2', 'jabatan' => 'Wakil Kepala Bidang Kesiswaan', 'foto' => asset('images/profileguru/david.png')],
            ['nama' => 'Waka 3', 'jabatan' => 'Wakil Kepala Bidang Hubungan Industri', 'foto' => asset('images/profileguru/deyan.png')],
            ['nama' => 'Waka 4', 'jabatan' => 'Wakil Kepala Bidang Sarana & Prasarana', 'foto' => asset('images/profileguru/eka.png')],
            ['nama' => 'Waka 5', 'jabatan' => 'Wakil Kepala Bidang SDM', 'foto' => asset('images/profileguru/faun.png')],
            ['nama' => 'Waka 6', 'jabatan' => 'Wakil Kepala Bidang Mutu', 'foto' => asset('images/profileguru/ferina.png')],
            ['nama' => 'Waka 7', 'jabatan' => 'Wakil Kepala Bidang IT', 'foto' => asset('images/profileguru/hadi.png')],
            ['nama' => 'Waka 8', 'jabatan' => 'Wakil Kepala Bidang Kemitraan', 'foto' => asset('images/profileguru/hamka.png')],
        ];

        // 3. Data Guru Produktif dan Non Produktif
        $guruMapel = [
            ['nama' => 'Guru 1', 'mapel' => 'Produktif SIJA', 'foto' => asset('images/profileguru/ike.png')],
            ['nama' => 'Guru 2', 'mapel' => 'Produktif TJAT', 'foto' => asset('images/profileguru/maul.png')],
            ['nama' => 'Guru 3', 'mapel' => 'Matematika', 'foto' => asset('images/profileguru/pai.png')],
            ['nama' => 'Guru 4', 'mapel' => 'Bahasa Inggris', 'foto' => asset('images/profileguru/rachel.png')],
            ['nama' => 'Guru 5', 'mapel' => 'Informatika', 'foto' => asset('images/profileguru/arga.png')],
            ['nama' => 'Guru 6', 'mapel' => 'PPKn', 'foto' => asset('images/profileguru/david.png')],
            ['nama' => 'Guru 7', 'mapel' => 'Sejarah Indonesia', 'foto' => asset('images/profileguru/deyan.png')],
            ['nama' => 'Guru 8', 'mapel' => 'Seni Budaya', 'foto' => asset('images/profileguru/eka.png')],
            ['nama' => 'Guru 9', 'mapel' => 'Simulasi Digital', 'foto' => asset('images/profileguru/faun.png')],
            ['nama' => 'Guru 10', 'mapel' => 'Fisika', 'foto' => asset('images/profileguru/ferina.png')],
            ['nama' => 'Guru 11', 'mapel' => 'Kimia', 'foto' => asset('images/profileguru/hadi.png')],
            ['nama' => 'Guru 12', 'mapel' => 'Agama Islam', 'foto' => asset('images/profileguru/hamka.png')],
            ['nama' => 'Guru 13', 'mapel' => 'PJOK', 'foto' => asset('images/profileguru/ike.png')],
            ['nama' => 'Guru 14', 'mapel' => 'Produktif RPL', 'foto' => asset('images/profileguru/maul.png')],
            ['nama' => 'Guru 15', 'mapel' => 'Desain Grafis', 'foto' => asset('images/profileguru/pai.png')],
            ['nama' => 'Guru 16', 'mapel' => 'IoT Dasar', 'foto' => asset('images/profileguru/rachel.png')],
            ['nama' => 'Guru 17', 'mapel' => 'Bimbingan Konseling', 'foto' => asset('images/profileguru/arga.png')],
            ['nama' => 'Guru 18', 'mapel' => 'Kewirausahaan', 'foto' => asset('images/profileguru/david.png')],
            ['nama' => 'Guru 19', 'mapel' => 'Bahasa Indonesia', 'foto' => asset('images/profileguru/deyan.png')],
            ['nama' => 'Guru 20', 'mapel' => 'Bahasa Jepang', 'foto' => asset('images/profileguru/eka.png')],
            ['nama' => 'Guru 21', 'mapel' => 'Animasi 2D/3D', 'foto' => asset('images/profileguru/faun.png')],
            ['nama' => 'Guru 22', 'mapel' => 'Basis Data', 'foto' => asset('images/profileguru/ferina.png')],
            ['nama' => 'Guru 23', 'mapel' => 'Pemrograman Web', 'foto' => asset('images/profileguru/hadi.png')],
            ['nama' => 'Guru 24', 'mapel' => 'Pemrograman Mobile', 'foto' => asset('images/profileguru/hamka.png')],
            ['nama' => 'Guru 25', 'mapel' => 'Jaringan Dasar', 'foto' => asset('images/profileguru/ike.png')],
            ['nama' => 'Guru 26', 'mapel' => 'Sistem Operasi', 'foto' => asset('images/profileguru/maul.png')],
            ['nama' => 'Guru 27', 'mapel' => 'Administrasi Server', 'foto' => asset('images/profileguru/pai.png')],
            ['nama' => 'Guru 28', 'mapel' => 'Keamanan Jaringan', 'foto' => asset('images/profileguru/rachel.png')],
            ['nama' => 'Guru 29', 'mapel' => 'Cloud Computing', 'foto' => asset('images/profileguru/arga.png')],
        ];

        // 4. Data Staff & Karyawan (Total 6 Orang - Tambah 2 Card)
        $staffKaryawan = [
            ['nama' => 'Staff 1', 'jabatan' => 'Tata Usaha / Administrasi', 'foto' => asset('images/profileguru/david.png')],
            ['nama' => 'Staff 2', 'jabatan' => 'Teknisi & IT Support', 'foto' => asset('images/profileguru/deyan.png')],
            ['nama' => 'Staff 3', 'jabatan' => 'Perpustakaan', 'foto' => asset('images/profileguru/eka.png')],
            ['nama' => 'Staff 4', 'jabatan' => 'Keamanan & Kebersihan', 'foto' => asset('images/profileguru/faun.png')],
            ['nama' => 'Staff 5', 'jabatan' => 'Laboran', 'foto' => asset('images/profileguru/ferina.png')], // Tambahan
            ['nama' => 'Staff 6', 'jabatan' => 'Hubungan Masyarakat', 'foto' => asset('images/profileguru/hadi.png')], // Tambahan
        ];

        return view('pages.profil-guru', compact('kepalaSekolah', 'wakaBidang', 'guruMapel', 'staffKaryawan'));
    }
}