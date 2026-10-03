<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    /**
     * Master Dataset Lengkap: 1 Kepala Sekolah, 8 Waka, 29 Guru, 6 Staff
     */
    private function getGuruDataset()
    {
        // 1. KEPALA SEKOLAH (1 Card)
        $kepalaSekolah = [
            'nama' => 'Abror S.Hum M.Pd',
            'slug' => 'abror-s-hum-m-pd',
            'foto' => asset('images/profileguru/pabror.webp'),
            'pendidikan' => 'S2 Manajemen Pendidikan',
            'keahlian' => 'Leadership & Digital Pedagogy',
            'jabatan' => 'Kepala Sekolah',
            'motto' => 'Belajar bukan sekedar mencari nilai, tapi membangun masa depan',
            'email' => 'abror@smktelkom-sda.sch.id',
            'deskripsi' => 'Guru yang berfokus pada pengembangan karakter dan keterampilan digital siswa, khususnya di bidang jaringan komputer dan teknologi informasi.',
        ];

        // 2. WAKIL KEPALA BIDANG (8 Card Sesuai Spesifikasi Anda)
        $wakaBidang = [
            [
                'nama' => 'Rachel Apriliani, S.Psi',
                'slug' => 'rachel-apriliani',
                'foto' => asset('images/profileguru/rachel.webp'),
                'jabatan' => 'Wakil Kepala Bidang Kesiswaan',
                'pendidikan' => 'S1 Psikologi Pendidikan',
                'keahlian' => 'Bimbingan Konseling',
                'email' => 'rachel@smktelkom-sda.sch.id',
                'deskripsi' => 'Guru yang berfokus pada pengembangan karakter dan kemampuan digital siswa dengan spesialisasi di bidang Bimbingan dan Konseling.',
            ],
            [
                'nama' => 'Bambang Sudarsono, S.Pd',
                'slug' => 'bambang-sudarsono',
                'foto' => asset('images/profileguru/rachel.webp'),
                'jabatan' => 'Wakil Kepala Bidang Kurikulum',
                'pendidikan' => 'S1 Pendidikan Teknologi Informasi',
                'keahlian' => 'Kurikulum Vokasi Digital',
                'email' => 'kurikulum@smktelkom-sda.sch.id',
                'deskripsi' => 'Bertanggung jawab atas penyusunan dan sinkronisasi kurikulum vokasi berbasis teknologi digital bersama mitra industri.',
            ],
            [
                'nama' => 'Hendra Setiawan, S.T',
                'slug' => 'hendra-setiawan',
                'foto' => asset('images/profileguru/adi.webp'),
                'jabatan' => 'Wakil Kepala Bidang Hubungan Industri',
                'pendidikan' => 'S1 Teknik Telekomunikasi',
                'keahlian' => 'Hubungan Industri & Magang',
                'email' => 'hubin@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengembangkan jejaring kemitraan strategis dengan dunia usaha dan industri untuk magang siswa dan rekrutmen kerja alumni.',
            ],
            [
                'nama' => 'Agus Wahyudi, S.T',
                'slug' => 'agus-wahyudi',
                'foto' => asset('images/profileguru/pabror.webp'),
                'jabatan' => 'Wakil Kepala Bidang Sarana & Prasarana',
                'pendidikan' => 'S1 Teknik Komputer',
                'keahlian' => 'Manajemen Fasilitas & Lab',
                'email' => 'sarpras@smktelkom-sda.sch.id',
                'deskripsi' => 'Memastikan seluruh laboratorium komputer, jaringan fiber optik, dan gedung sekolah berada dalam standar industri prima.',
            ],
            [
                'nama' => 'Dewi Sartika, M.Pd',
                'slug' => 'dewi-sartika',
                'foto' => asset('images/profileguru/ike.webp'),
                'jabatan' => 'Wakil Kepala Bidang Penjaminan Mutu',
                'pendidikan' => 'S2 Administrasi Pendidikan',
                'keahlian' => 'Sistem Manajemen Mutu ISO 21001',
                'email' => 'mutu@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengawal standarisasi manajemen mutu ISO pendidikan internasional di lingkungan SMK Telkom Sidoarjo.',
            ],
            [
                'nama' => 'Ferry Anugerah, S.Kom',
                'slug' => 'ferry-anugerah',
                'foto' => asset('images/profileguru/adi.webp'),
                'jabatan' => 'Wakil Kepala Bidang Digitalisasi Sekolah',
                'pendidikan' => 'S1 Sistem Informasi',
                'keahlian' => 'Smart School Platform',
                'email' => 'digital@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengembangkan ekosistem digitalisasi sistem sekolah, aplikasi e-learning, dan automasi pembelajaran terpadu.',
            ],
            [
                'nama' => 'Maya Anggraini, S.Pd',
                'slug' => 'maya-anggraini',
                'foto' => asset('images/profileguru/rachel.webp'),
                'jabatan' => 'Wakil Kepala Bidang Keasramaan & Karakter',
                'pendidikan' => 'S1 Bimbingan Konseling',
                'keahlian' => 'Pendidikan Karakter & Kedisiplinan',
                'email' => 'karakter@smktelkom-sda.sch.id',
                'deskripsi' => 'Membina kedisiplinan, akhlak, dan integritas mental siswa sebagai pondasi lulusan vokasi yang tangguh.',
            ],
            [
                'nama' => 'Rizky Pratama, S.ST',
                'slug' => 'rizky-pratama',
                'foto' => asset('images/profileguru/adi.webp'),
                'jabatan' => 'Wakil Kepala Bidang Kewirausahaan & UPJ',
                'pendidikan' => 'D4 Manajemen Informatika',
                'keahlian' => 'Business Incubator & Startup',
                'email' => 'upj@smktelkom-sda.sch.id',
                'deskripsi' => 'Memimpin unit produksi jasa (UPJ) dan inkubator bisnis siswa untuk melatih kemampuan technopreneurship.',
            ],
        ];

        // 3. GURU PRODUKTIF & NON PRODUKTIF (29 Card Sesuai Spesifikasi Anda)
        $namaGuruData = [
            'Ike Yuliastuti, S.Kom' => 'Guru Produktif SIJA',
            'Muhammad Adi Riswanto, S.T' => 'Guru Produktif TJAT',
            'Ahmad Fajar Santoso, S.Kom' => 'Guru Produktif SIJA',
            'Siti Nurhaliza, S.Pd' => 'Guru Bahasa Inggris',
            'Dwi Cahyo Utomo, M.Pd' => 'Guru Matematika',
            'Budi Setiawan, S.T' => 'Guru Produktif TJAT',
            'Rina Marlina, S.Pd' => 'Guru Bahasa Indonesia',
            'Eko Prasetyo, S.Kom' => 'Guru Produktif SIJA',
            'Tri Wahyuni, S.Pd' => 'Guru Pendidikan Agama',
            'Aris Munandar, S.T' => 'Guru Produktif TJAT',
            'Fitri Handayani, S.Kom' => 'Guru Produktif SIJA',
            'Hadi Pranoto, S.Pd' => 'Guru Pendidikan Jasmani & Olahraga',
            'Lestari Indah, S.Pd' => 'Guru Sejarah Indonesia',
            'Gunawan Wibisono, S.Kom' => 'Guru Produktif SIJA',
            'Yulia Safitri, S.Pd' => 'Guru Bimbingan Konseling',
            'Andik Irawan, S.T' => 'Guru Produktif TJAT',
            'Nita Anggraeni, S.Kom' => 'Guru Produktif SIJA',
            'Rudi Hartono, S.Pd' => 'Guru Seni Budaya',
            'Megawati, S.Pd' => 'Guru PPKn',
            'Dani Kurniawan, S.Kom' => 'Guru Produktif SIJA',
            'Suryanto, S.T' => 'Guru Produktif TJAT',
            'Ratna Sari, S.Pd' => 'Guru Kimia Terapan',
            'Indra Kusuma, S.Kom' => 'Guru Produktif SIJA',
            'Dina Mariana, S.Pd' => 'Guru Fisika Terapan',
            'Agung Wicaksono, S.T' => 'Guru Produktif TJAT',
            'Lina Rosita, S.Kom' => 'Guru Produktif SIJA',
            'Bayu Pamungkas, S.Pd' => 'Guru Muatan Lokal & Bahasa Jawa',
            'Kartika Candra, S.Kom' => 'Guru Produktif SIJA',
            'Wawan Sulistyo, S.T' => 'Guru Produktif TJAT',
        ];

        $guruMapel = [];
        $i = 1;
        foreach ($namaGuruData as $nama => $mapel) {
            // Rotasi foto agar dinamis
            $foto = ($i % 3 == 0) ? asset('images/profileguru/ike.webp') : (($i % 2 == 0) ? asset('images/profileguru/adi.webp') : asset('images/profileguru/pabror.webp'));
            
            $guruMapel[] = [
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'foto' => $foto,
                'mapel' => $mapel,
                'jabatan' => $mapel,
                'pendidikan' => 'S1 / S2 Pendidikan Vokasi Terakreditasi',
                'keahlian' => $mapel . ' & Digital Learning',
                'email' => Str::slug(explode(',', $nama)[0]) . '@smktelkom-sda.sch.id',
                'deskripsi' => 'Guru pengajar profesional yang berdedikasi membimbing dan mengasah kompetensi siswa SMK Telkom Sidoarjo di bidang ' . $mapel . '.',
            ];
            $i++;
        }

        // 4. STAFF & KARYAWAN (6 Card Sesuai Spesifikasi Anda)
        $staffKaryawan = [
            [
                'nama' => 'Nurul Hidayati, S.E',
                'slug' => 'nurul-hidayati',
                'foto' => asset('images/profileguru/rachel.webp'),
                'jabatan' => 'Kepala Urusan Keuangan',
                'pendidikan' => 'S1 Akuntansi Keuangan',
                'keahlian' => 'Administrasi & Billing',
                'email' => 'keuangan@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengelola sistem administrasi keuangan dan pembayaran pendidikan siswa secara akuntabel dan transparan.',
            ],
            [
                'nama' => 'Budi Prasetyo, A.Md',
                'slug' => 'budi-prasetyo',
                'foto' => asset('images/profileguru/adi.webp'),
                'jabatan' => 'Kepala Tata Usaha',
                'pendidikan' => 'D3 Manajemen Informatika',
                'keahlian' => 'Administrasi & Kearsipan',
                'email' => 'tatausaha@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengkoordinasikan pelayanan administrasi persuratan, data pokok pendidikan (Dapodik), dan layanan kesiswaan.',
            ],
            [
                'nama' => 'Rian Hidayat, S.Kom',
                'slug' => 'rian-hidayat',
                'foto' => asset('images/profileguru/pabror.webp'),
                'jabatan' => 'Laboran & IT Support',
                'pendidikan' => 'S1 Teknik Informatika',
                'keahlian' => 'Hardware & Server Maintenance',
                'email' => 'itsupport@smktelkom-sda.sch.id',
                'deskripsi' => 'Memastikan seluruh perangkat komputer laboratorium, server e-learning, dan jaringan WiFi sekolah berjalan prima.',
            ],
            [
                'nama' => 'Dewi Anggraini, S.Hum',
                'slug' => 'dewi-anggraini',
                'foto' => asset('images/profileguru/ike.webp'),
                'jabatan' => 'Pustakawan Digital',
                'pendidikan' => 'S1 Ilmu Perpustakaan',
                'keahlian' => 'Literasi Digital & E-Library',
                'email' => 'perpustakaan@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengelola koleksi buku fisik, e-book, jurnal sains, serta fasilitas ruang baca digital SMK Telkom Sidoarjo.',
            ],
            [
                'nama' => 'Slamet Riyadi, S.AP',
                'slug' => 'slamet-riyadi',
                'foto' => asset('images/profileguru/adi.webp'),
                'jabatan' => 'Staf Administrasi Kepegawaian',
                'pendidikan' => 'S1 Administrasi Publik',
                'keahlian' => 'Kepegawaian & SDM Sekolah',
                'email' => 'sdm@smktelkom-sda.sch.id',
                'deskripsi' => 'Menangani administrasi tenaga pendidik dan kependidikan, rekrutmen internal, serta pembinaan kompetensi berkala.',
            ],
            [
                'nama' => 'Citra Maharani, S.I.Kom',
                'slug' => 'citra-maharani',
                'foto' => asset('images/profileguru/rachel.webp'),
                'jabatan' => 'Staf Hubungan Masyarakat (Humas)',
                'pendidikan' => 'S1 Ilmu Komunikasi',
                'keahlian' => 'Public Relations & Branding',
                'email' => 'humas@smktelkom-sda.sch.id',
                'deskripsi' => 'Mengelola publikasi resmi sekolah, media sosial, kemitraan media massa, serta komunikasi dengan orang tua murid.',
            ],
        ];

        return compact('kepalaSekolah', 'wakaBidang', 'guruMapel', 'staffKaryawan');
    }

    /**
     * Menampilkan Katalog Profil Guru (Desktop - 23(1).png)
     */
    public function index()
    {
        $data = $this->getGuruDataset();

        return view('pages.profil-guru', [
            'kepalaSekolah' => $data['kepalaSekolah'],
            'wakaBidang'    => $data['wakaBidang'],    // Pas 8 Card
            'guruMapel'     => $data['guruMapel'],     // Pas 29 Card
            'staffKaryawan' => $data['staffKaryawan'], // Pas 6 Card
            'guruDetail'    => null,
        ]);
    }

    /**
     * Menampilkan Detail Guru Dinamis (Desktop - 42.png)
     */
    public function show($slug)
    {
        $data = $this->getGuruDataset();

        // Gabungkan seluruh orang untuk pencarian detail
        $all = collect([$data['kepalaSekolah']])
            ->merge($data['wakaBidang'])
            ->merge($data['guruMapel'])
            ->merge($data['staffKaryawan']);

        $guruDetail = $all->first(function ($item) use ($slug) {
            return ($item['slug'] ?? Str::slug($item['nama'])) === $slug;
        });

        if (!$guruDetail) {
            $guruDetail = $data['wakaBidang'][0]; // Fallback ke Rachel Apriliani
        }

        return view('pages.profil-guru', [
            'kepalaSekolah' => null,
            'wakaBidang'    => [],
            'guruMapel'     => [],
            'staffKaryawan' => [],
            'guruDetail'    => $guruDetail,
        ]);
    }
}