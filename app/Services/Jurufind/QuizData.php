<?php

namespace App\Services\Jurufind;

class QuizData
{
    /**
     * 20 pertanyaan model tally langsung: setiap option berkontribusi ke satu jurusan
     * ('major' => 'S'|'T') dengan bobot 'weight' => 1|2.
     *
     * Simetris by design: tiap soal punya persis 2 opsi S dan 2 opsi T, dan total
     * poin maksimum kedua jurusan sama persis. Tidak ada perkalian bobot dimensi.
     */
    public static function questions(): array
    {
        return [
            ['id' => 'q01', 'question' => 'Saat menghadapi masalah rumit, kamu lebih suka...', 'options' => [
                ['id' => 'a', 'label' => 'Coba-coba langsung dan lihat hasilnya secara fisik', 'major' => 'T', 'weight' => 2],
                ['id' => 'b', 'label' => 'Memecahnya jadi langkah logis di kepala dulu', 'major' => 'S', 'weight' => 2],
                ['id' => 'c', 'label' => 'Utak-atik alat sampai ketemu solusinya', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Bikin daftar langkah penyelesaian dulu sebelum mulai', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q02', 'question' => 'Kegiatan yang bikin kamu betah berjam-jam...', 'options' => [
                ['id' => 'a', 'label' => 'Merakit atau memperbaiki barang dengan tangan', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Ngoprek pengaturan/sistem di HP atau laptop', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Menyusun sesuatu yang rapi & terstruktur di layar', 'major' => 'S', 'weight' => 1],
                ['id' => 'd', 'label' => 'Bongkar pasang perangkat elektronik', 'major' => 'T', 'weight' => 1],
            ]],
            ['id' => 'q03', 'question' => 'Ketika WiFi rumah mati, reaksi pertamamu...', 'options' => [
                ['id' => 'a', 'label' => 'Cek kabel/perangkat fisiknya langsung', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Restart router dan cek pengaturan jaringan', 'major' => 'T', 'weight' => 1],
                ['id' => 'c', 'label' => 'Cek pengaturan/software di HP dulu', 'major' => 'S', 'weight' => 1],
                ['id' => 'd', 'label' => 'Cari tau lewat forum/tutorial online kenapa bisa putus', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q04', 'question' => 'Kamu lebih menikmati game yang...', 'options' => [
                ['id' => 'a', 'label' => 'Melibatkan simulasi mekanik/fisik', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Mengharuskan strategi & logika rumit', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Membangun sesuatu dari komponen-komponen', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Menyusun sistem/alur yang kompleks', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q05', 'question' => 'Saat presentasi project sekolah, kamu lebih pede...', 'options' => [
                ['id' => 'a', 'label' => 'Menunjukkan cara kerja alat secara langsung', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Menjelaskan alur/logika di baliknya', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Mendemonstrasikan perangkat yang berfungsi nyata', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Menjelaskan proses berpikir di balik solusinya', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q06', 'question' => 'Kalau punya 1 jam luang dan cuma boleh pegang 1 alat, kamu pilih...', 'options' => [
                ['id' => 'a', 'label' => 'Toolkit kecil (obeng, kabel, dll)', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Notebook untuk menulis rencana/skema', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Perangkat jaringan buat dioprek', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Laptop untuk coding/desain', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q07', 'question' => 'Saat belajar hal baru, kamu lebih cepat paham lewat...', 'options' => [
                ['id' => 'a', 'label' => 'Langsung praktik & coba sendiri', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Membaca konsep & logikanya dulu', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Mempraktikkan langsung di alat nyata', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Memahami teori di baliknya dulu', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q08', 'question' => 'Ada 2 tugas: bikin alur program sederhana vs pasang alat elektronik sederhana. Kamu kerjakan duluan...', 'options' => [
                ['id' => 'a', 'label' => 'Pasang alat', 'major' => 'T', 'weight' => 2],
                ['id' => 'b', 'label' => 'Alur program', 'major' => 'S', 'weight' => 2],
                ['id' => 'c', 'label' => 'Tugas yang melibatkan perangkat fisik', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Tugas yang melibatkan logika pemrograman', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q09', 'question' => 'Saat komputer tiba-tiba lag/error, kamu penasaran...', 'options' => [
                ['id' => 'a', 'label' => 'Ingin cek fisik komponennya', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Apa yang salah di sistemnya', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Kenapa hardware-nya bisa bermasalah', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Kenapa software-nya bisa error', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q10', 'question' => 'Kamu lebih suka cerita/film dengan tema...', 'options' => [
                ['id' => 'a', 'label' => 'Petualangan, membangun sesuatu dari nol', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Dunia digital, teknologi masa depan', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Eksplorasi dan penemuan fisik', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Kecerdasan buatan dan dunia maya', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q11', 'question' => 'Dalam kerja kelompok, peran paling nyaman buatmu...', 'options' => [
                ['id' => 'a', 'label' => 'Mengerjakan bagian teknis/pemasangan langsung', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Merancang alur/rencana kerja tim', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Turun langsung ke eksekusi teknis', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Menyusun konsep/strategi tim', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q12', 'question' => 'Barang yang paling menarik perhatianmu di toko elektronik...', 'options' => [
                ['id' => 'a', 'label' => 'Perangkat jaringan (router, kabel, modem)', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Laptop/gadget spesifikasi tinggi', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Alat instalasi/perkabelan', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Software atau aplikasi baru', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q13', 'question' => 'Kamu lebih suka tantangan yang hasilnya...', 'options' => [
                ['id' => 'a', 'label' => 'Terlihat lewat koneksi/sistem yang menyala & jalan', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Terlihat lewat aplikasi/tampilan yang berfungsi', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Terlihat lewat perangkat yang berhasil terpasang', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Terlihat lewat program yang berhasil dijalankan', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q14', 'question' => 'Saat ditanya cita-cita, kamu paling sering kebayang...', 'options' => [
                ['id' => 'a', 'label' => 'Kerja lapangan pasang & benerin jaringan/alat', 'major' => 'T', 'weight' => 2],
                ['id' => 'b', 'label' => 'Bikin aplikasi/produk digital sendiri', 'major' => 'S', 'weight' => 2],
                ['id' => 'c', 'label' => 'Jadi teknisi yang turun langsung ke lokasi', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Jadi developer yang kerja di balik layar', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q15', 'question' => 'Kalau harus pilih ekstrakurikuler, kamu tertarik ke...', 'options' => [
                ['id' => 'a', 'label' => 'Klub elektro/otomotif', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Klub robotika/coding', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Klub yang banyak praktik alat', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Klub yang banyak logika & pemrograman', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q16', 'question' => 'Kamu lebih nyaman kerja di lingkungan yang...', 'options' => [
                ['id' => 'a', 'label' => 'Aktif berpindah tempat/lapangan', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Tenang, duduk lama di depan layar', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Banyak aktivitas fisik & teknis', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Fokus dan minim gangguan untuk mikir', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q17', 'question' => 'Saat lihat sesuatu canggih (misal drone/robot), kamu paling penasaran...', 'options' => [
                ['id' => 'a', 'label' => 'Bagaimana rangkaian/hardware-nya dibuat', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Bagaimana program/otaknya bekerja', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Cara kerja komponen fisiknya', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Cara kerja algoritma di dalamnya', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q18', 'question' => 'Pelajaran sekolah yang paling gampang buatmu...', 'options' => [
                ['id' => 'a', 'label' => 'Fisika/kelistrikan/praktik bengkel', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Matematika logika/pemrograman dasar', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Praktik kerja teknis di lab', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Logika & algoritma dasar', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q19', 'question' => 'Kalau masalah teknis butuh waktu lama selesai, kamu...', 'options' => [
                ['id' => 'a', 'label' => 'Tetap coba-coba manual sampai berhasil', 'major' => 'T', 'weight' => 1],
                ['id' => 'b', 'label' => 'Tetap sabar riset sampai ketemu solusi logisnya', 'major' => 'S', 'weight' => 1],
                ['id' => 'c', 'label' => 'Terus eksperimen dengan alat sampai berhasil', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Terus cari pola/logika sampai ketemu jawabannya', 'major' => 'S', 'weight' => 1],
            ]],
            ['id' => 'q20', 'question' => 'Bayangkan 10 tahun lagi, kamu ingin dikenal sebagai orang yang...', 'options' => [
                ['id' => 'a', 'label' => 'Jago membangun infrastruktur teknologi', 'major' => 'T', 'weight' => 2],
                ['id' => 'b', 'label' => 'Jago bikin sistem/aplikasi', 'major' => 'S', 'weight' => 2],
                ['id' => 'c', 'label' => 'Ahli di lapangan teknis', 'major' => 'T', 'weight' => 1],
                ['id' => 'd', 'label' => 'Ahli merancang solusi digital', 'major' => 'S', 'weight' => 1],
            ]],
        ];
    }

    public static function majors(): array
    {
        return [
            'SIJA' => [
                'id' => 'SIJA',
                'fullName' => 'Sistem Informasi Jaringan dan Aplikasi',
                'shortName' => 'SIJA',
                'duration' => '4 tahun',
                'intro' => 'Kamu memiliki ketertarikan yang kuat dalam memecahkan masalah kompleks lewat logika dan baris kode. Dengan potensi ini, jurusan SIJA adalah pilihan yang sangat cocok untuk mengembangkan bakat digitalmu ke tingkat berikutnya.',
                'learningAreas' => [
                    'Komputer dan Jaringan Dasar', 'Platform Komputasi Awan', 'Sistem Internet of Things (SIoT)',
                    'Sistem Komputer', 'Pemrograman Dasar', 'Dasar Desain Grafis', 'Infrastruktur Komputasi Awan',
                    'Layanan Komputasi Awan', 'Sistem Keamanan Jaringan', 'Produk Kreatif dan Kewirausahaan',
                ],
            ],
            'TJAT' => [
                'id' => 'TJAT',
                'fullName' => 'Teknik Jaringan Akses Telekomunikasi',
                'shortName' => 'TJAT',
                'duration' => '3 tahun',
                'intro' => 'Kamu memiliki ketertarikan yang kuat pada kerja teknis langsung dan infrastruktur fisik — dari kabel, perangkat jaringan, sampai instalasi lapangan. Dengan potensi ini, jurusan TJAT adalah pilihan yang sangat cocok untuk mengasah keahlian teknismu.',
                'learningAreas' => [
                    'Jaringan Fiber Optic', 'Jaringan Komputer', 'Jaringan Nirkabel / Wireless', 'Pemrograman Web',
                    'Desain Grafis', 'Internet of Things (IoT)', 'Sistem Keamanan Jaringan', 'Produk Kreatif dan Kewirausahaan',
                ],
            ],
        ];
    }

    public static function nearTieThresholds(): array
    {
        return ['close' => 10, 'leaning' => 20]; // >20 = 'clear'
    }
}
