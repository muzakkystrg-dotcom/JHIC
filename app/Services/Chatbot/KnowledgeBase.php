<?php

namespace App\Services\Chatbot;

class KnowledgeBase
{
    /**
     * Ringkasan terstruktur seluruh informasi publik SMK Telkom Sidoarjo,
     * disusun dari isi asli resources/views/**.blade.php + config/*.php yang
     * menjadi sumber data halaman-halaman dinamis (lihat SKOMDA_AI_CHATBOT_SPEC.md
     * §3 untuk daftar file sumber & metodologi ringkasan).
     *
     * PENTING: isi di bawah ini WAJIB hasil baca langsung dari blade views /
     * config asli, BUKAN dikarang. Update ulang method ini kalau konten halaman
     * berubah.
     */
    public static function content(): string
    {
        return <<<'KB'
        # PROFIL SEKOLAH
        - Nama resmi & paling formal: SMK Telkom Sidoarjo.
        - Sebutan populer di situs: "Skomda" / "SKOMDA".
        - Jenis: SMK bidang Teknologi dan Informatika (vokasi).
        - Naungan: Yayasan Pendidikan Telkom (YPT), bagian dari grup pendidikan Telkom Indonesia.
        - Berdiri tahun 2018.
        - Akreditasi: "A (UNGGUL)" dengan nilai 93, berdasarkan Keputusan BAN-S/M Nomor 1336/BAN-SM/SK/2021, berlaku sampai 31 Desember 2026.
        - Standar mutu: ISO 21001:2018 (standar manajemen pendidikan internasional).
        - Identitas singkat: "Sekolah Tangguh, Berakhlak, Berwawasan Digital" / School of Digital Era.
        - Kepala Sekolah: Abror S.Hum M.Pd.
        - Visi: Mewujudkan Lulusan Tangguh, Berakhlak, dan Berwawasan Digital.
        - Misi: (1) Mengembangkan sistem pembinaan peserta didik untuk membentuk lulusan yang berkarakter tangguh, berakhlak, dan berwawasan digital; (2) Menyelenggarakan pendidikan dengan kurikulum Link and Match di bidang Teknologi Informasi; (3) Mewujudkan lulusan yang siap Bekerja, Melanjutkan, atau Wirausaha (BMW).
        - Kurikulum: Kurikulum Nasional Plus / Kurikulum Merdeka TS.21, berorientasi Link and Match dengan Dunia Usaha dan Industri (DUDI).
        - Program pendukung: Digital Talent Program (DTP), Program OPES (jalur pendidikan berkelanjutan dari SMK hingga perguruan tinggi Telkom).

        # JURUSAN
        ## SIJA - Sistem Informasi Jaringan dan Aplikasi (program 4 tahun)
        - Kompetensi keahlian berbasis Teknologi Informasi dan Komunikasi, mulai dibuka Tahun Pelajaran 2017/2018, dengan masa pembelajaran 4 (empat) tahun.
        - Fokus belajar: merancang dan mengembangkan aplikasi/website, pemrograman, cloud computing, Internet of Things (IoT), dan keamanan jaringan.
        - Cocok untuk: yang suka coding/membuat aplikasi serta senang berpikir logis dan memecahkan masalah.
        - Prospek kerja yang disebut: Software Engineer, Web Developer, UI/UX Designer, Cloud Engineer, Fullstack Developer, Cyber Security, UI Designer.
        - Gambaran silabus: Semester 1-2 Dasar Pemrograman, Jaringan Dasar, Sistem Komputer, dan Logika Algoritma; Semester 3-4 Pemrograman Web & Mobile, Basis Data Relasional, Administrasi Server; Semester 5-6 Cloud Infrastructure (AWS/GCP), IoT, Cyber Security; Semester 7-8 Praktik Kerja Industri 1 tahun (full internship) dan Capstone Project.
        - Jalur lanjutan: linier ke jurusan Teknik Informatika dan Sistem Informasi.
        - Guru Produktif SIJA: Ike Yuliastuti.

        ## TJAT - Teknik Jaringan Akses Telekomunikasi (program 3 tahun)
        - Melatih siswa memahami, mengoperasikan, dan memelihara perangkat utama serta pendukung jaringan telekomunikasi. Siswa menguasai jaringan akses berbasis Tembaga, Fiber Optik, dan Radio.
        - Fokus belajar: perancangan, instalasi, pemeliharaan, hingga optimasi jaringan transmisi (fiber optic dan komunikasi nirkabel/wireless) dari penyedia layanan sampai ke pengguna.
        - Prospek kerja yang disebut: Network Engineer, IT Support, Fiber Optic Technician.
        - Gambaran silabus: Semester 1-2 Dasar Telekomunikasi, Rangkaian Listrik & Elektronika, Keselamatan Kerja (K3); Semester 3-4 Teknologi Fiber Optik (Splicing & OTDR), Transmisi Radio & VSAT, Jaringan Seluler; Semester 5-6 Sistem Komunikasi Nirkabel Modern, PKL Industri Telekomunikasi, dan Uji Sertifikasi BNSP.
        - Jalur lanjutan: linier ke jurusan Teknik Elektro dan Teknik Komputer.
        - Guru Produktif TJAT: Muhammad Adi Riswanto.
        - Catatan: program 3 tahun membuat lulusan lebih cepat siap kerja di ISP maupun perusahaan telekomunikasi.

        # PPDB (PENERIMAAN PESERTA DIDIK BARU)
        - Periode yang ditampilkan di situs: PPDB 2026/2027.
        - Alur pendaftaran: (1) Pendaftaran online dan melengkapi formulir dengan data diri yang benar; (2) Mengikuti serangkaian tes: Tes Kemampuan Dasar, Psikotes, dan Wawancara; (3) Jika lolos seleksi, wajib daftar ulang, segera lakukan pembayaran dan lengkapi berkas administrasi; (4) Resmi menjadi siswa SMK Telkom Sidoarjo.
        - Biaya: Formulir PPDB Rp 100.000 (sekali bayar); Daftar ulang Rp 50.000 setiap semester; SPP Rp 500.000 per bulan.
        - Dokumen yang dibutuhkan: fotokopi Kartu Keluarga; surat kesehatan Puskesmas; ijazah SMP calon siswa; fotokopi rapor SMP calon siswa. (FAQ juga menyebut pas foto berwarna 3x4 dan surat keterangan bebas buta warna dari puskesmas/dokter, serta rapor SMP semester 1-5.)
        - Beasiswa: tersedia jalur beasiswa Yayasan Pendidikan Telkom bagi siswa berprestasi.
        - Alur pembelajaran: Kelas X - pengenalan konsep dasar teknologi digital dan mini project; Kelas XI - pemilihan kelas peminatan Digital Talent Program (DTP) dengan bimbingan mentor profesional dan proyek kolaborasi lintas kelas; Kelas XII - untuk program 4 tahun: mata pelajaran umum kejuruan, penilaian akhir kelulusan, program inkubasi; untuk program 3 tahun: Praktik Kerja Lapangan, penilaian akhir kelulusan, sertifikasi kompetensi, Program BMW; Kelas XIII (khusus SIJA) - Fourth Year Program 4 tahun, Praktik Kerja Lapangan, sertifikasi kompetensi, Program BMW.
        - Ada juga info pengambilan brosur di halaman PPDB.

        # FASILITAS
        - Laboratorium praktik berstandar industri: Lab Komputer, Lab Jaringan/Telekomunikasi, Lab AI (komputasi tinggi untuk kecerdasan buatan, machine learning, computer vision, deep learning), Lab IoT (sensor, mikrokontroler, simulator otomatisasi).
        - Gedung RPS Hall: pusat pengembangan teknologi dua lantai, dilengkapi aula luas dengan videotron modern serta dua ruang IoT.
        - Gedung utama sekolah dengan arsitektur modern berstandar industri digital.
        - Kantin bersih dan higienis dengan transaksi digital cashless.
        - Lapangan Basket (outdoor multifungsi untuk basket, futsal, dan aktivitas fisik).
        - Outdoor Class: OC Besar (presentasi proyek industri, workshop) dan OC Kecil (koordinasi tim kecil, mentoring).

        # EKSTRAKURIKULER
        - Paskibraka (kedisiplinan, kepemimpinan, nasionalisme lewat baris-berbaris dan tata upacara bendera).
        - Futsal (sepak bola mini, kerja sama tim, sportivitas).
        - Esport (gaming kompetitif: game strategi MOBA dan FPS).
        - Ambalan Penegak (gugus depan Gerakan Pramuka: karakter, mandiri, cinta alam, kepemimpinan Pancasila).

        # PRESTASI
        - Halaman prestasi menyajikan grafik prestasi siswa pada tingkat Kabupaten, Provinsi, Nasional, dan Internasional.
        - Contoh prestasi yang disebut di berita: Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026 oleh tim SIJA dalam ajang Lomba Keterampilan Siswa (LKS).

        # ALUMNI & KARIER
        - Informasi Alumni: halaman data kelulusan yang transparan dan bisa diakses siswa serta orang tua/wali. Pencarian data alumni menggunakan nomor SSO; kolom yang ditampilkan: Nama Siswa, Jurusan, DTP, dan SSO.
        - Career Center: menghubungkan talenta muda sekolah dengan industri teknologi; menyediakan peluang magang/PKL, pekerjaan, dan pengembangan karier. Terdapat fitur "HireLink!" untuk para alumni mencari kesempatan kerja dengan mitra sekolah. Menampilkan lowongan kerja terbaru dari mitra industri (jenis dari full-time hingga PKL).
        - Agenda event: Sidoarjo School Job Fair 2026 di Lippo Mall Sidoarjo.
        - Digital Talent Program (DTP): kelas peminatan eksklusif di SMK Telkom Sidoarjo dengan 9 bidang spesialisasi teknologi, dipilih mulai Kelas XI. Bidangnya: Software Developer, Cloud Engineer, Digital Marketing Specialist, CyberSecurity, NIE (jaringan fiber optic, routing BGP/OSPF, switching enterprise), NSA (administrasi sistem Linux/Windows Server, virtualisasi), DKV (UI/UX, desain grafis, motion graphics), AI Specialist (machine learning, deep learning, prompt engineering, integrasi API AI), dan IoT (sensor, mikrokontroler ESP32/Raspberry Pi, protokol MQTT, smart home).

        # MITRA INDUSTRI
        - Sekolah menampilkan lebih dari 13 mitra industri. Nama mitra yang tercantum antara lain: Axelbit; DigiPrener; Jagoan Hosting; Markaz Design; PT Garuda Telekomunikasi Indonesia; PT Global Infra Teknologi; PT Javacreatiox Network Intermedia (web development, CCTV, IoT, IT support); PT Radnet Digital Indonesia / radneXt (Internet Service Provider berlisensi Kementerian Komunikasi dan Informatika RI); Wowrack Indonesia (cloud computing, data center, hosting); dan Weza Group - PT Weza Punya Cerita (solusi B2B lewat Weza Solutions).
        - Kerja sama mencakup Kelas Industri, jalur magang prioritas, dan rekrutmen kerja langsung sebelum kelulusan (MoU dengan mitra telekomunikasi).

        # PROGRAM LAIN
        - Program CCP (Character, Process, Content): membekali siswa dengan skill tambahan dan kreativitas yang relevan dengan industri. Pillar Character: Program SCBC, Pramuka, kegiatan rohani, pengembangan soft skill. Pillar Process: menggunakan CAFE, berbasis ICT, pembelajaran interaktif, Project Based Learning. Pillar Content: Kurikulum Nasional, Link and Match dengan DUDI, serta English program (pelatihan bahasa Inggris untuk guru, English day setiap Kamis, English corner).
        - Program TS21: kurikulum unggulan yang fokus pada Kompetensi Abad 21 dengan Blended Learning, Project-Based, dan Studio Classroom. Mengimplementasikan Kurikulum Merdeka TS.21 yang menyeimbangkan Soft Skill (karakter & Digital Talent), Hard Skill, dan Life Skill.
        - Trial Class: siswa calon bisa mengikuti Trial Class untuk merasakan langsung suasana, metode pengajaran, dan fasilitas sekolah. Terdapat jadwal per jurusan dengan kuota, instruktur, tanggal, dan jam.
        - Penerapan K3 (Keselamatan dan Kesehatan Kerja): diterapkan di semua kegiatan praktik dan laboratorium; siswa dibekali standar K3 industri. Terdapat dokumen K3 yang bisa diunduh.
        - Silabus: halaman silabus pembelajaran SIJA dan TJAT (Kurikulum Merdeka). Sekolah terakreditasi A, mengacu Standar Kompetensi Kerja Nasional Indonesia (SKKNI), dan Teaching Factory Telkom Schools.
        - Tes Minat Bakat: JURUFIND adalah tes minat bakat untuk membantu calon siswa menemukan jurusan yang cocok (20 pertanyaan, estimasi 6-7 menit).

        # KONTAK
        - Email resmi: informasi@smktelkom-sda.sch.id
        - WhatsApp resmi: 0811-3021-919
        - Alamat: Jl. Raya Pecantingan Sekardangan, Sidoarjo, Jawa Timur
        KB;
    }
}
