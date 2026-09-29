# Spec: Kuis Jurufind (SIJA vs TJAT) — Implementasi Laravel

## 0. Konteks

Ini adalah port dari prototype yang sudah pernah dibangun di Next.js (kuis eksplorasi minat
SIJA vs TJAT untuk calon siswa SMK), sekarang dipindah ke struktur **Laravel classic MVC**
(Blade + vanilla JS/CSS di `public/assets/`) mengikuti repo yang sudah ada. **Jangan install
framework frontend baru (React/Vue/dll), jangan tambah Tailwind/Vite build step baru** — ikuti
pola yang sudah ada di repo ini (lihat `public/assets/js/home.js`, `public/assets/js/ppdb.js`,
`public/assets/css/ppdb.css` sebagai referensi konvensi).

Struktur repo yang relevan (sudah ada):

```text
app/Http/Controllers/
├── Controller.php
└── MitraIndustriController.php        # contoh konvensi naming controller
config/services.php                     # taruh config provider AI di sini
routes/web.php
resources/views/
├── jurufind.blade.php                  # halaman info/landing jurufind (JANGAN diubah)
└── jurufind/                           # folder baru untuk view kuis
    └── test.blade.php                  # <- kuis ditaruh di sini
public/assets/
├── css/jurufind.css                    # <- style kuis ditaruh di sini
└── js/jurufind.js                      # <- logic kuis (vanilla JS) ditaruh di sini
```

## 1. Keputusan Arsitektur (WAJIB diikuti, jangan diubah tanpa alasan kuat)

1. **Single-page experience**: satu view (`test.blade.php`) berisi DUA "state" — state
   kuis (pertanyaan + progress bar) dan state hasil (result) — di-toggle pakai vanilla JS
   (show/hide), TANPA reload halaman dan TANPA route/view terpisah untuk result. Ini
   supaya state kuis nggak hilang antar-pertanyaan dan UX-nya smooth.
2. **Scoring dihitung di server (PHP), BUKAN di JS.** Ini beda dari versi Next.js sebelumnya
   (yang scoring-nya di client). Alasan: satu source of truth, JS jadi jauh lebih simpel
   (cuma render pertanyaan + kumpulin jawaban), dan nggak ada logic bisnis yang
   terduplikasi di dua bahasa.
   - JS cuma mengumpulkan `answers` (map `question_id => option_id`) lalu POST ke server.
   - Server yang menghitung skor dimensi minat → skor jurusan → persentase → primary
     major → near-tie tier, BARU setelah itu memanggil AI provider untuk bikin penjelasan.
3. **AI provider (GripHubRouter, model `deepseek-v4-flash`) HANYA dipanggil dari server**
   (service class PHP). API key TIDAK PERNAH boleh muncul di Blade/JS/browser.
4. **AI TIDAK PERNAH menghitung ulang persentase.** Persentase sudah final dari
   `ScoringService` sebelum dikirim ke AI. AI cuma mengubah angka yang sudah jadi
   menjadi penjelasan bahasa natural.
5. **Kalau AI provider gagal/invalid/timeout, tetap harus ada fallback deterministik**
   supaya halaman hasil tetap berfungsi (lihat `FallbackExplanationBuilder`).
6. **Endpoint kuis pakai `routes/web.php` (bukan `routes/api.php`)** karena project ini
   belum punya `routes/api.php`. Request AJAX dari JS wajib kirim CSRF token lewat
   header `X-CSRF-TOKEN` (ambil dari meta tag), bukan via Sanctum/API token.

## 2. File yang harus dibuat/diubah

```text
BUAT BARU:
├── app/Services/Jurufind/QuizData.php
├── app/Services/Jurufind/ScoringService.php
├── app/Services/Jurufind/ExplanationService.php
├── app/Services/Jurufind/ResponseValidator.php
├── app/Services/Jurufind/FallbackExplanationBuilder.php
├── app/Services/Jurufind/ProviderException.php
├── app/Http/Controllers/JurufindController.php
├── app/Http/Requests/AnalyzeJurufindRequest.php
├── resources/views/jurufind/test.blade.php
├── public/assets/js/jurufind.js
├── public/assets/css/jurufind.css
├── tests/Unit/Jurufind/ScoringServiceTest.php
└── tests/Unit/Jurufind/ResponseValidatorTest.php

UBAH:
├── routes/web.php                      # tambah 2 route, JANGAN hapus route yang sudah ada
├── config/services.php                 # tambah key 'griphubrouter'
└── .env                                 # tambah GRIPHUBROUTER_API_KEY & GRIPHUBROUTER_MODEL
                                          # (file .env sudah ada, tinggal tambah baris — key-nya
                                          # sudah dipunya user, TANYA ke user kalau perlu)
```

## 3. Environment variables

Tambahkan ke `.env` (dan contohkan di `.env.example` kalau ada):

```env
GRIPHUBROUTER_API_KEY=
GRIPHUBROUTER_MODEL=deepseek-v4-flash
```

Tambahkan ke `config/services.php`:

```php
'griphubrouter' => [
    'key' => env('GRIPHUBROUTER_API_KEY'),
    'model' => env('GRIPHUBROUTER_MODEL', 'deepseek-v4-flash'),
],
```

## 4. Data kuis — `app/Services/Jurufind/QuizData.php`

Class statis berisi 20 pertanyaan, data 2 jurusan, label dimensi, bobot scoring, dan
threshold near-tie. **Salin persis** — ini data yang sudah divalidasi secara desain di
versi sebelumnya, jangan diringkas atau diubah urutannya.

```php
<?php

namespace App\Services\Jurufind;

class QuizData
{
    /**
     * 20 pertanyaan, mixed text / image / situational.
     * Setiap option punya 'scores' = kontribusi ke satu atau lebih dimensi minat.
     */
    public static function questions(): array
    {
        return [
            [
                'id' => 'q01', 'type' => 'text',
                'question' => 'Kalau jaringan internet di sebuah tempat bermasalah, apa yang paling ingin kamu lakukan?',
                'options' => [
                    ['id' => 'a', 'label' => 'Mencari penyebab masalah jaringannya', 'image' => null, 'scores' => ['networking' => 3, 'problem_solving' => 2]],
                    ['id' => 'b', 'label' => 'Membuat program untuk membantu menemukan masalah', 'image' => null, 'scores' => ['programming' => 3, 'system_development' => 2]],
                    ['id' => 'c', 'label' => 'Mengecek perangkat dan kabel satu per satu', 'image' => null, 'scores' => ['hands_on' => 3, 'fiber_optic' => 1]],
                    ['id' => 'd', 'label' => 'Mencari cara lain supaya perangkat tetap terhubung', 'image' => null, 'scores' => ['wireless' => 2, 'problem_solving' => 2]],
                ],
            ],
            [
                'id' => 'q02', 'type' => 'image',
                'question' => 'Aktivitas mana yang paling menarik buat kamu coba?',
                'options' => [
                    ['id' => 'a', 'label' => 'Ngoding', 'image' => '/assets/images/jurufind/coding.svg', 'scores' => ['programming' => 3, 'system_development' => 2]],
                    ['id' => 'b', 'label' => 'Bikin alat pintar sederhana', 'image' => '/assets/images/jurufind/iot.svg', 'scores' => ['iot' => 3, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Mengatur server dan cloud', 'image' => '/assets/images/jurufind/network.svg', 'scores' => ['cloud' => 3, 'networking' => 1]],
                    ['id' => 'd', 'label' => 'Masang kabel fiber optic', 'image' => '/assets/images/jurufind/fiber.svg', 'scores' => ['fiber_optic' => 3, 'hands_on' => 2]],
                ],
            ],
            [
                'id' => 'q03', 'type' => 'situational',
                'question' => 'Kamu diberi waktu satu hari untuk mencoba sebuah proyek. Mana yang paling menarik?',
                'options' => [
                    ['id' => 'a', 'label' => 'Membuat aplikasi sederhana', 'image' => null, 'scores' => ['programming' => 3, 'system_development' => 1]],
                    ['id' => 'b', 'label' => 'Membuat jaringan antar beberapa perangkat', 'image' => null, 'scores' => ['networking' => 3]],
                    ['id' => 'c', 'label' => 'Menyambungkan perangkat menggunakan fiber optic', 'image' => null, 'scores' => ['fiber_optic' => 3, 'hands_on' => 2]],
                    ['id' => 'd', 'label' => 'Membuat perangkat IoT sederhana', 'image' => null, 'scores' => ['iot' => 3, 'programming' => 1]],
                ],
            ],
            [
                'id' => 'q04', 'type' => 'text',
                'question' => 'Kalau kamu diberi kesempatan mencoba salah satu hal ini, mana yang paling menarik?',
                'options' => [
                    ['id' => 'a', 'label' => 'Menyusun aplikasi atau website sederhana', 'image' => null, 'scores' => ['programming' => 3, 'creativity' => 1]],
                    ['id' => 'b', 'label' => 'Menata sistem cloud biar aplikasi bisa jalan online', 'image' => null, 'scores' => ['cloud' => 3, 'system_development' => 1]],
                    ['id' => 'c', 'label' => 'Memasang dan mengatur jaringan wireless di sebuah gedung', 'image' => null, 'scores' => ['wireless' => 3, 'hands_on' => 1]],
                    ['id' => 'd', 'label' => 'Menjaga supaya jaringan aman dari serangan', 'image' => null, 'scores' => ['cybersecurity' => 3, 'problem_solving' => 1]],
                ],
            ],
            [
                'id' => 'q05', 'type' => 'text',
                'question' => 'Mana yang paling kebayang seru buat kamu kerjakan?',
                'options' => [
                    ['id' => 'a', 'label' => 'Membuat aplikasi yang bisa dipakai banyak orang', 'image' => null, 'scores' => ['programming' => 3, 'creativity' => 1]],
                    ['id' => 'b', 'label' => 'Memasang jaringan komunikasi biar orang-orang bisa saling terhubung', 'image' => null, 'scores' => ['telecommunications' => 3, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Menjaga supaya sistem selalu berjalan dan aman', 'image' => null, 'scores' => ['cybersecurity' => 2, 'system_development' => 2]],
                    ['id' => 'd', 'label' => 'Bereksperimen dengan alat-alat pintar (IoT)', 'image' => null, 'scores' => ['iot' => 3]],
                ],
            ],
            [
                'id' => 'q06', 'type' => 'situational',
                'question' => 'Kamu jadi ketua panitia acara sekolah. Bagian mana yang paling pengen kamu pegang?',
                'options' => [
                    ['id' => 'a', 'label' => 'Bikin website pendaftaran acara', 'image' => null, 'scores' => ['programming' => 3]],
                    ['id' => 'b', 'label' => 'Pasang wifi buat semua peserta', 'image' => null, 'scores' => ['wireless' => 3, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Atur supaya data peserta tersimpan aman di cloud', 'image' => null, 'scores' => ['cloud' => 2, 'cybersecurity' => 2]],
                    ['id' => 'd', 'label' => 'Pastikan semua kabel dan perangkat di lokasi acara nyambung dengan baik', 'image' => null, 'scores' => ['hands_on' => 3, 'fiber_optic' => 1]],
                ],
            ],
            [
                'id' => 'q07', 'type' => 'text',
                'question' => 'Waktu belajar hal baru soal teknologi, kamu lebih suka...',
                'options' => [
                    ['id' => 'a', 'label' => 'Coba-coba ngoding sampai programnya jalan', 'image' => null, 'scores' => ['programming' => 3, 'problem_solving' => 1]],
                    ['id' => 'b', 'label' => 'Bongkar pasang perangkat keras buat lihat cara kerjanya', 'image' => null, 'scores' => ['hands_on' => 3]],
                    ['id' => 'c', 'label' => 'Cari tahu cara kerja sinyal wifi atau radio', 'image' => null, 'scores' => ['wireless' => 3]],
                    ['id' => 'd', 'label' => 'Eksperimen bikin alat yang bisa nyambung ke internet', 'image' => null, 'scores' => ['iot' => 3]],
                ],
            ],
            [
                'id' => 'q08', 'type' => 'image',
                'question' => 'Ruangan mana yang paling menarik buat kamu kerja di dalamnya?',
                'options' => [
                    ['id' => 'a', 'label' => 'Ruang server penuh layar dan baris kode', 'image' => '/assets/images/jurufind/network.svg', 'scores' => ['cloud' => 2, 'programming' => 2]],
                    ['id' => 'b', 'label' => 'Ruang teknisi dengan alat sambung kabel fiber', 'image' => '/assets/images/jurufind/fiber.svg', 'scores' => ['fiber_optic' => 3, 'hands_on' => 2]],
                    ['id' => 'c', 'label' => 'Rooftop dengan antena dan perangkat wireless', 'image' => '/assets/images/jurufind/wireless.svg', 'scores' => ['wireless' => 3]],
                    ['id' => 'd', 'label' => 'Lab elektronik dengan berbagai sensor IoT', 'image' => '/assets/images/jurufind/iot.svg', 'scores' => ['iot' => 3]],
                ],
            ],
            [
                'id' => 'q09', 'type' => 'situational',
                'question' => 'Internet di rumah tiba-tiba mati total. Langkah pertama kamu?',
                'options' => [
                    ['id' => 'a', 'label' => 'Cek pengaturan software di router', 'image' => null, 'scores' => ['networking' => 2, 'problem_solving' => 2]],
                    ['id' => 'b', 'label' => 'Cek kabel fisik dan modemnya', 'image' => null, 'scores' => ['hands_on' => 3, 'fiber_optic' => 1]],
                    ['id' => 'c', 'label' => 'Coba pindah dulu ke jaringan seluler', 'image' => null, 'scores' => ['wireless' => 2]],
                    ['id' => 'd', 'label' => 'Cari tahu penyebabnya secara runtut sebelum bertindak', 'image' => null, 'scores' => ['problem_solving' => 3, 'system_development' => 1]],
                ],
            ],
            [
                'id' => 'q10', 'type' => 'text',
                'question' => 'Kalau harus pilih proyek buat lomba sekolah, kamu pilih...',
                'options' => [
                    ['id' => 'a', 'label' => 'Bikin aplikasi mobile keren', 'image' => null, 'scores' => ['programming' => 3, 'creativity' => 1]],
                    ['id' => 'b', 'label' => 'Bikin sistem smart home sederhana', 'image' => null, 'scores' => ['iot' => 3, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Bikin jaringan komputer buat lab sekolah', 'image' => null, 'scores' => ['networking' => 3]],
                    ['id' => 'd', 'label' => 'Pasang jaringan internet pakai fiber optic buat sekolah', 'image' => null, 'scores' => ['fiber_optic' => 3, 'telecommunications' => 1]],
                ],
            ],
            [
                'id' => 'q11', 'type' => 'image',
                'question' => 'Mana yang menurutmu paling seru buat dipelajari?',
                'options' => [
                    ['id' => 'a', 'label' => 'Bahasa pemrograman baru', 'image' => '/assets/images/jurufind/coding.svg', 'scores' => ['programming' => 3]],
                    ['id' => 'b', 'label' => 'Cara kerja jaringan telekomunikasi', 'image' => '/assets/images/jurufind/fiber.svg', 'scores' => ['telecommunications' => 3]],
                    ['id' => 'c', 'label' => 'Cara kerja komputasi awan', 'image' => '/assets/images/jurufind/network.svg', 'scores' => ['cloud' => 3]],
                    ['id' => 'd', 'label' => 'Cara kerja perangkat IoT', 'image' => '/assets/images/jurufind/iot.svg', 'scores' => ['iot' => 3]],
                ],
            ],
            [
                'id' => 'q12', 'type' => 'situational',
                'question' => 'Kamu magang seminggu di sebuah perusahaan teknologi. Divisi mana yang kamu pilih?',
                'options' => [
                    ['id' => 'a', 'label' => 'Divisi developer aplikasi', 'image' => null, 'scores' => ['programming' => 3, 'system_development' => 2]],
                    ['id' => 'b', 'label' => 'Divisi jaringan dan infrastruktur kantor', 'image' => null, 'scores' => ['networking' => 3, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Divisi keamanan sistem', 'image' => null, 'scores' => ['cybersecurity' => 3]],
                    ['id' => 'd', 'label' => 'Divisi instalasi dan perawatan jaringan telekomunikasi pelanggan', 'image' => null, 'scores' => ['telecommunications' => 3, 'hands_on' => 2]],
                ],
            ],
            [
                'id' => 'q13', 'type' => 'text',
                'question' => 'Kalau ditanya cita-cita di bidang teknologi, kamu paling kebayang jadi...',
                'options' => [
                    ['id' => 'a', 'label' => 'Software developer', 'image' => null, 'scores' => ['programming' => 3, 'system_development' => 1]],
                    ['id' => 'b', 'label' => 'Cloud engineer', 'image' => null, 'scores' => ['cloud' => 3]],
                    ['id' => 'c', 'label' => 'Teknisi jaringan lapangan', 'image' => null, 'scores' => ['hands_on' => 3, 'telecommunications' => 1]],
                    ['id' => 'd', 'label' => 'Spesialis keamanan jaringan', 'image' => null, 'scores' => ['cybersecurity' => 3]],
                ],
            ],
            [
                'id' => 'q14', 'type' => 'situational',
                'question' => 'Tetangga minta bantuan karena internetnya lambat. Apa yang kamu lakukan?',
                'options' => [
                    ['id' => 'a', 'label' => 'Cek dan atur ulang pengaturan router', 'image' => null, 'scores' => ['networking' => 2, 'problem_solving' => 1]],
                    ['id' => 'b', 'label' => 'Cek kualitas kabel dan koneksi fisiknya', 'image' => null, 'scores' => ['hands_on' => 2, 'fiber_optic' => 1]],
                    ['id' => 'c', 'label' => 'Sarankan pindah ke provider dengan jaringan fiber optic', 'image' => null, 'scores' => ['fiber_optic' => 2, 'telecommunications' => 1]],
                    ['id' => 'd', 'label' => 'Analisis penyebabnya secara sistematis dulu', 'image' => null, 'scores' => ['problem_solving' => 3]],
                ],
            ],
            [
                'id' => 'q15', 'type' => 'text',
                'question' => 'Kegiatan ekstrakurikuler teknologi mana yang bikin kamu penasaran?',
                'options' => [
                    ['id' => 'a', 'label' => 'Klub coding atau robotika software', 'image' => null, 'scores' => ['programming' => 2, 'system_development' => 1]],
                    ['id' => 'b', 'label' => 'Klub jaringan komputer', 'image' => null, 'scores' => ['networking' => 3]],
                    ['id' => 'c', 'label' => 'Klub elektronika dan IoT', 'image' => null, 'scores' => ['iot' => 3]],
                    ['id' => 'd', 'label' => 'Klub radio atau komunikasi', 'image' => null, 'scores' => ['wireless' => 2, 'telecommunications' => 2]],
                ],
            ],
            [
                'id' => 'q16', 'type' => 'image',
                'question' => 'Kalau harus pegang salah satu alat ini, kamu pilih yang mana?',
                'options' => [
                    ['id' => 'a', 'label' => 'Laptop buat ngoding', 'image' => '/assets/images/jurufind/coding.svg', 'scores' => ['programming' => 3]],
                    ['id' => 'b', 'label' => 'Tang crimping dan kabel jaringan', 'image' => '/assets/images/jurufind/hardware.svg', 'scores' => ['hands_on' => 3, 'networking' => 1]],
                    ['id' => 'c', 'label' => 'Alat splicing fiber optic', 'image' => '/assets/images/jurufind/fiber.svg', 'scores' => ['fiber_optic' => 3]],
                    ['id' => 'd', 'label' => 'Modul sensor IoT', 'image' => '/assets/images/jurufind/iot.svg', 'scores' => ['iot' => 3]],
                ],
            ],
            [
                'id' => 'q17', 'type' => 'situational',
                'question' => 'Ada tugas kelompok bikin proyek teknologi buat pameran sekolah. Bagian mana yang paling pengen kamu ambil?',
                'options' => [
                    ['id' => 'a', 'label' => 'Menulis kode program aplikasinya', 'image' => null, 'scores' => ['programming' => 3]],
                    ['id' => 'b', 'label' => 'Menyiapkan server/cloud biar aplikasi bisa jalan', 'image' => null, 'scores' => ['cloud' => 3, 'system_development' => 1]],
                    ['id' => 'c', 'label' => 'Memasang jaringan dan perangkat di lokasi pameran', 'image' => null, 'scores' => ['hands_on' => 3, 'networking' => 1]],
                    ['id' => 'd', 'label' => 'Memikirkan desain tampilan biar menarik', 'image' => null, 'scores' => ['creativity' => 3]],
                ],
            ],
            [
                'id' => 'q18', 'type' => 'text',
                'question' => 'Menurutmu, hal paling penting saat internet dipakai banyak orang sekaligus adalah...',
                'options' => [
                    ['id' => 'a', 'label' => 'Aplikasinya harus jalan lancar tanpa error', 'image' => null, 'scores' => ['system_development' => 2, 'programming' => 1]],
                    ['id' => 'b', 'label' => 'Jaringannya harus stabil dan cepat', 'image' => null, 'scores' => ['networking' => 3]],
                    ['id' => 'c', 'label' => 'Datanya harus aman dari peretas', 'image' => null, 'scores' => ['cybersecurity' => 3]],
                    ['id' => 'd', 'label' => 'Sinyalnya harus kuat sampai ke pelosok', 'image' => null, 'scores' => ['telecommunications' => 2, 'wireless' => 2]],
                ],
            ],
            [
                'id' => 'q19', 'type' => 'situational',
                'question' => 'Weekend santai, kamu lebih milih ngapain?',
                'options' => [
                    ['id' => 'a', 'label' => 'Belajar bahasa pemrograman baru lewat tutorial', 'image' => null, 'scores' => ['programming' => 3]],
                    ['id' => 'b', 'label' => 'Otak-atik router atau access point di rumah', 'image' => null, 'scores' => ['networking' => 2, 'hands_on' => 1]],
                    ['id' => 'c', 'label' => 'Baca-baca soal teknologi wireless atau 5G', 'image' => null, 'scores' => ['wireless' => 3]],
                    ['id' => 'd', 'label' => 'Coba rakit alat elektronik sederhana', 'image' => null, 'scores' => ['iot' => 2, 'hands_on' => 2]],
                ],
            ],
            [
                'id' => 'q20', 'type' => 'text',
                'question' => 'Kalau kamu jadi bagian tim yang membangun jaringan internet ke desa terpencil, bagian mana yang paling pengen kamu kerjakan?',
                'options' => [
                    ['id' => 'a', 'label' => 'Merancang sistem/aplikasi buat monitoring jaringan', 'image' => null, 'scores' => ['system_development' => 3, 'programming' => 1]],
                    ['id' => 'b', 'label' => 'Menarik kabel fiber optic ke lokasi', 'image' => null, 'scores' => ['fiber_optic' => 3, 'hands_on' => 2]],
                    ['id' => 'c', 'label' => 'Memasang menara dan perangkat wireless', 'image' => null, 'scores' => ['wireless' => 3, 'hands_on' => 1]],
                    ['id' => 'd', 'label' => 'Memastikan semuanya aman dari gangguan', 'image' => null, 'scores' => ['cybersecurity' => 2, 'problem_solving' => 1]],
                ],
            ],
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
                'intro' => 'SIJA cocok buat kamu yang tertarik dengan dunia komputer secara luas: mulai dari bikin aplikasi, mengelola jaringan, sampai bermain dengan cloud dan IoT. Jurusan ini memadukan pemrograman, infrastruktur, dan keamanan sistem dalam satu program 4 tahun.',
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
                'intro' => 'TJAT cocok buat kamu yang suka kerja teknis dan langsung berhubungan dengan infrastruktur jaringan telekomunikasi: kabel tembaga, fiber optic, sampai jaringan nirkabel/wireless. Jurusan 3 tahun ini fokus pada bagaimana jaringan akses telekomunikasi dibangun, dioperasikan, dan dirawat.',
                'learningAreas' => [
                    'Jaringan Fiber Optic', 'Jaringan Komputer', 'Jaringan Nirkabel / Wireless', 'Pemrograman Web',
                    'Desain Grafis', 'Internet of Things (IoT)', 'Sistem Keamanan Jaringan', 'Produk Kreatif dan Kewirausahaan',
                ],
            ],
        ];
    }

    public static function dimensionLabels(): array
    {
        return [
            'programming' => 'Programming', 'networking' => 'Networking', 'cloud' => 'Cloud', 'iot' => 'IoT',
            'cybersecurity' => 'Keamanan Siber', 'telecommunications' => 'Telekomunikasi', 'fiber_optic' => 'Fiber Optic',
            'wireless' => 'Wireless', 'hands_on' => 'Kerja Teknis Langsung', 'problem_solving' => 'Problem Solving',
            'system_development' => 'Pengembangan Sistem', 'creativity' => 'Kreativitas',
        ];
    }

    /** Bobot dimensi per jurusan. Prototype, bukan alat ukur bakat tervalidasi. */
    public static function majorDimensionWeights(): array
    {
        return [
            'SIJA' => [
                'programming' => 1.0, 'networking' => 0.8, 'cloud' => 1.0, 'iot' => 0.75, 'cybersecurity' => 0.75,
                'system_development' => 1.0, 'problem_solving' => 0.75, 'telecommunications' => 0.35, 'wireless' => 0.35,
                'fiber_optic' => 0.2, 'hands_on' => 0.5, 'creativity' => 0.4,
            ],
            'TJAT' => [
                'programming' => 0.35, 'networking' => 0.9, 'cloud' => 0.25, 'iot' => 0.6, 'cybersecurity' => 0.5,
                'system_development' => 0.3, 'problem_solving' => 0.8, 'telecommunications' => 1.0, 'wireless' => 0.9,
                'fiber_optic' => 1.0, 'hands_on' => 0.95, 'creativity' => 0.3,
            ],
        ];
    }

    public static function nearTieThresholds(): array
    {
        return ['close' => 10, 'leaning' => 20]; // >20 = 'clear'
    }

    public const TOP_DIMENSIONS_COUNT = 3;
}
```

> Catatan gambar: path `/assets/images/jurufind/*.svg` masih placeholder — buat SVG
> sederhana (kotak warna + teks label) di `public/assets/images/jurufind/` persis
> seperti pola `coding.svg`, `iot.svg`, `network.svg`, `fiber.svg`, `wireless.svg`,
> `hardware.svg`. Boleh diganti aset asli nanti tanpa mengubah `QuizData.php`.

## 5. Scoring engine — `app/Services/Jurufind/ScoringService.php`

Logic deterministik, TIDAK bergantung ke AI provider sama sekali:

```php
<?php

namespace App\Services\Jurufind;

class ScoringService
{
    /**
     * @param array<string,string> $answers  [question_id => option_id]
     * @return array{
     *   majorPercentages: array{SIJA:int,TJAT:int},
     *   primaryMajor: string,
     *   difference: int,
     *   tier: string,
     *   dimensionScores: array<string,int>,
     *   topDimensions: array<int, array{dimension:string, score:int}>
     * }
     */
    public function score(array $answers): array
    {
        $dimensionScores = $this->calculateDimensionScores($answers);

        $weights = QuizData::majorDimensionWeights();
        $rawScores = ['SIJA' => 0.0, 'TJAT' => 0.0];

        foreach (['SIJA', 'TJAT'] as $major) {
            $sum = 0.0;
            foreach ($dimensionScores as $dimension => $score) {
                $weight = $weights[$major][$dimension] ?? 0;
                $sum += $score * $weight;
            }
            $rawScores[$major] = $sum;
        }

        $totalRaw = $rawScores['SIJA'] + $rawScores['TJAT'];

        $sijaExact = $totalRaw > 0 ? ($rawScores['SIJA'] / $totalRaw) * 100 : 50;

        $sijaPct = (int) round($sijaExact);
        $tjatPct = 100 - $sijaPct;
        if ($tjatPct < 0) {
            $tjatPct = 0;
            $sijaPct = 100;
        }

        $primaryMajor = $sijaPct >= $tjatPct ? 'SIJA' : 'TJAT';
        $difference = abs($sijaPct - $tjatPct);
        $tier = $this->classifyTier($difference);

        arsort($dimensionScores);
        $topDimensions = [];
        $i = 0;
        foreach ($dimensionScores as $dimension => $score) {
            if ($i >= QuizData::TOP_DIMENSIONS_COUNT) break;
            $topDimensions[] = ['dimension' => $dimension, 'score' => $score];
            $i++;
        }

        return [
            'majorPercentages' => ['SIJA' => $sijaPct, 'TJAT' => $tjatPct],
            'primaryMajor' => $primaryMajor,
            'difference' => $difference,
            'tier' => $tier,
            'dimensionScores' => $dimensionScores,
            'topDimensions' => $topDimensions,
        ];
    }

    private function calculateDimensionScores(array $answers): array
    {
        $totals = [];
        foreach (QuizData::questions() as $question) {
            $selectedOptionId = $answers[$question['id']] ?? null;
            if (!$selectedOptionId) continue;

            $option = collect($question['options'])->firstWhere('id', $selectedOptionId);
            if (!$option) continue;

            foreach ($option['scores'] as $dimension => $value) {
                $totals[$dimension] = ($totals[$dimension] ?? 0) + $value;
            }
        }
        return $totals;
    }

    private function classifyTier(int $difference): string
    {
        $thresholds = QuizData::nearTieThresholds();
        if ($difference <= $thresholds['close']) return 'close';
        if ($difference <= $thresholds['leaning']) return 'leaning';
        return 'clear';
    }

    /** True kalau semua 20 pertanyaan sudah terjawab dengan option id yang valid. */
    public function isComplete(array $answers): bool
    {
        foreach (QuizData::questions() as $question) {
            $selected = $answers[$question['id']] ?? null;
            if (!$selected) return false;
            $valid = collect($question['options'])->pluck('id')->contains($selected);
            if (!$valid) return false;
        }
        return true;
    }
}
```

## 6. AI explanation layer

### 6a. `app/Services/Jurufind/ProviderException.php`

```php
<?php

namespace App\Services\Jurufind;

class ProviderException extends \RuntimeException {}
```

### 6b. `app/Services/Jurufind/ResponseValidator.php`

```php
<?php

namespace App\Services\Jurufind;

class ResponseValidator
{
    /** Validasi bentuk JSON balikan AI sebelum dipercaya. */
    public static function isValid(mixed $data): bool
    {
        if (!is_array($data)) return false;

        if (!in_array($data['primaryMajor'] ?? null, ['SIJA', 'TJAT'], true)) return false;
        if (!is_string($data['summary'] ?? null) || trim($data['summary']) === '') return false;

        if (!is_array($data['reasons'] ?? null)) return false;
        foreach ($data['reasons'] as $reason) {
            if (!is_string($reason)) return false;
        }

        if (!is_array($data['topInterests'] ?? null)) return false;
        foreach ($data['topInterests'] as $item) {
            if (!is_array($item)) return false;
            if (!is_string($item['name'] ?? null)) return false;
            if (!is_numeric($item['score'] ?? null)) return false;
        }

        if (!is_string($data['comparison'] ?? null)) return false;

        return true;
    }
}
```

### 6c. `app/Services/Jurufind/FallbackExplanationBuilder.php`

```php
<?php

namespace App\Services\Jurufind;

class FallbackExplanationBuilder
{
    /** Dipakai kalau AI provider gagal/invalid — hasil tetap harus bisa ditampilkan. */
    public static function build(array $scoring): array
    {
        $primaryMajor = $scoring['primaryMajor'];
        $difference = $scoring['difference'];
        $labels = QuizData::dimensionLabels();

        $dimensionScores = $scoring['dimensionScores'];
        arsort($dimensionScores);
        $topInterests = [];
        $i = 0;
        foreach ($dimensionScores as $dimension => $score) {
            if ($i >= 3) break;
            $topInterests[] = ['name' => $labels[$dimension] ?? $dimension, 'score' => $score];
            $i++;
        }

        $summary = $difference <= 10
            ? "Berdasarkan hasil kuis, jawabanmu menunjukkan kecocokan dengan SIJA dan TJAT, tetapi sedikit lebih condong ke {$primaryMajor}. Penjelasan AI sementara tidak tersedia."
            : "Berdasarkan hasil kuis, jawabanmu lebih condong ke {$primaryMajor}. Penjelasan AI sementara tidak tersedia.";

        return [
            'primaryMajor' => $primaryMajor,
            'summary' => $summary,
            'reasons' => ["Skor kamu untuk {$primaryMajor} lebih tinggi dibanding pilihan lainnya berdasarkan jawabanmu di kuis."],
            'topInterests' => $topInterests,
            'comparison' => 'Detail perbandingan minat antar jurusan belum bisa ditampilkan karena penjelasan AI sedang tidak tersedia.',
            'fallback' => true,
        ];
    }
}
```

### 6d. `app/Services/Jurufind/ExplanationService.php`

```php
<?php

namespace App\Services\Jurufind;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExplanationService
{
    private const ENDPOINT = 'https://griphubrouter.web.id/v1/chat/completions';

    /** Titik masuk utama: coba AI, fallback deterministik kalau gagal. */
    public function explain(array $scoring): array
    {
        try {
            return $this->callProvider($scoring);
        } catch (ProviderException $e) {
            Log::warning('[Jurufind] Falling back to deterministic explanation: ' . $e->getMessage());
            return FallbackExplanationBuilder::build($scoring);
        }
    }

    private function callProvider(array $scoring): array
    {
        $apiKey = config('services.griphubrouter.key');
        if (!$apiKey) {
            throw new ProviderException('GRIPHUBROUTER_API_KEY is not configured.');
        }
        $model = config('services.griphubrouter.model', 'deepseek-v4-flash');

        try {
            $response = Http::withToken($apiKey)
                ->timeout(15)
                ->post(self::ENDPOINT, [
                    'model' => $model,
                    'messages' => [['role' => 'user', 'content' => $this->buildPrompt($scoring)]],
                    'response_format' => ['type' => 'json_object'],
                    'temperature' => 0.4,
                ]);
        } catch (\Throwable $e) {
            throw new ProviderException('GripHubRouter request failed: ' . $e->getMessage());
        }

        if ($response->failed()) {
            $detail = $response->json('error.message') ?? $response->json('message') ?? $response->body();
            throw new ProviderException("GripHubRouter responded with status {$response->status()}: {$detail}");
        }

        $text = $response->json('choices.0.message.content');
        if (!$text) {
            throw new ProviderException('GripHubRouter response had no message content.');
        }

        $parsed = json_decode($this->stripCodeFence($text), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ProviderException('GripHubRouter response was not valid JSON.');
        }

        if (!ResponseValidator::isValid($parsed)) {
            throw new ProviderException('GripHubRouter response did not match the expected schema.');
        }

        return $parsed;
    }

    /** Beberapa provider OpenAI-compatible suka bungkus JSON dalam ```json fences. */
    private function stripCodeFence(string $text): string
    {
        $trimmed = trim($text);
        if (preg_match('/^```(?:json)?\s*([\s\S]*?)\s*```$/i', $trimmed, $m)) {
            return $m[1];
        }
        return $trimmed;
    }

    private function buildPrompt(array $scoring): string
    {
        $majors = QuizData::majors();
        $payload = [
            'majorScores' => $scoring['majorPercentages'],
            'difference' => $scoring['difference'],
            'primaryMajor' => $scoring['primaryMajor'],
            'dimensions' => $scoring['dimensionScores'],
        ];

        $shape = <<<SHAPE
        {
          "primaryMajor": "SIJA" | "TJAT",
          "summary": string,
          "reasons": string[],
          "topInterests": [{ "name": string, "score": number }],
          "comparison": string
        }
        SHAPE;

        return <<<PROMPT
        Kamu adalah asisten yang menjelaskan hasil kuis eksplorasi minat jurusan SMK (SIJA vs TJAT) kepada calon siswa.

        ATURAN WAJIB:
        1. Persentase SIJA dan TJAT SUDAH dihitung secara deterministik oleh sistem. JANGAN mengubah, menghitung ulang, atau mengoreksi angka tersebut.
        2. JANGAN mengarang skor baru atau jawaban pengguna yang tidak diberikan.
        3. Hanya gunakan dimensi minat dan info jurusan yang diberikan di bawah ini.
        4. Jawab dalam Bahasa Indonesia yang santai dan mudah dipahami calon siswa SMK (bukan bahasa akademis/formal).
        5. Ikuti aturan near-tie berikut:
           - Selisih 0-10: kedua jurusan punya kecocokan yang berarti; jurusan dengan persentase lebih tinggi tetap disebut sebagai kecenderungan utama, tapi JANGAN menjelekkan jurusan yang lebih rendah.
           - Selisih 11-20: kecenderungan ke jurusan yang lebih tinggi sudah cukup jelas, tapi jurusan lain masih relevan.
           - Selisih di atas 20: jurusan dengan persentase lebih tinggi disajikan sebagai rekomendasi utama.
        6. JANGAN mengklaim kepastian mutlak. Hindari kalimat seperti "kamu pasti cocok di X". Gunakan gaya seperti "hasilmu lebih condong ke...".
        7. Kembalikan HANYA satu objek JSON valid, TANPA teks lain di luar JSON, TANPA markdown code fence, persis dengan bentuk berikut:
        {$shape}

        DATA HASIL KUIS (jangan diubah):
        {$this->jsonEncode($payload)}

        INFORMASI JURUSAN (konteks terpercaya, jangan mengarang fakta baru):
        SIJA: {$majors['SIJA']['fullName']}. {$majors['SIJA']['intro']}
        TJAT: {$majors['TJAT']['fullName']}. {$majors['TJAT']['intro']}

        Selisih persentase saat ini: {$scoring['difference']} poin. Jurusan dengan persentase lebih tinggi: {$scoring['primaryMajor']}.
        PROMPT;
    }

    private function jsonEncode(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
```

## 7. Request validation — `app/Http/Requests/AnalyzeJurufindRequest.php`

Endpoint menerima jawaban mentah (`answers`), BUKAN skor yang sudah dihitung — server
yang berdaulat penuh atas scoring (lihat §1 poin 2).

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyzeJurufindRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'string'],
        ];
    }
}
```

## 8. Controller — `app/Http/Controllers/JurufindController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyzeJurufindRequest;
use App\Services\Jurufind\ExplanationService;
use App\Services\Jurufind\QuizData;
use App\Services\Jurufind\ScoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class JurufindController extends Controller
{
    public function __construct(
        private readonly ScoringService $scoringService,
        private readonly ExplanationService $explanationService,
    ) {}

    /** GET /jurufind/test — render halaman kuis, hydrate data pertanyaan ke JS. */
    public function test(): View
    {
        return view('jurufind.test', [
            'questions' => QuizData::questions(),
            'majors' => QuizData::majors(),
        ]);
    }

    /** POST /jurufind/analyze — hitung skor + minta penjelasan AI (atau fallback). */
    public function analyze(AnalyzeJurufindRequest $request): JsonResponse
    {
        $answers = $request->validated()['answers'];

        if (!$this->scoringService->isComplete($answers)) {
            return response()->json([
                'error' => 'Belum semua pertanyaan terjawab.',
            ], 422);
        }

        $scoring = $this->scoringService->score($answers);
        $explanation = $this->explanationService->explain($scoring);

        return response()->json([
            'scoring' => $scoring,
            'explanation' => $explanation,
        ]);
    }
}
```

## 9. Routes — tambahkan ke `routes/web.php`

**Jangan hapus route yang sudah ada.** Tambahkan di bagian bawah file atau di dekat
route jurufind lain yang sudah ada:

```php
use App\Http\Controllers\JurufindController;

Route::get('/jurufind/test', [JurufindController::class, 'test'])->name('jurufind.test');

Route::post('/jurufind/analyze', [JurufindController::class, 'analyze'])
    ->middleware('throttle:20,1') // batasi 20 request/menit per IP, cegah spam ke AI provider
    ->name('jurufind.analyze');
```

## 10. View — `resources/views/jurufind/test.blade.php`

Struktur minimum yang harus ada (boleh dibungkus layout existing kalau ada
`layouts/app.blade.php` yang cocok — cek dulu isinya sebelum extend):

```blade
@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/jurufind.css') }}">

<main id="jurufind-app" class="jurufind-app" data-analyze-url="{{ route('jurufind.analyze') }}">
    {{-- STATE 1: Kuis --}}
    <section id="jurufind-quiz-stage" class="jf-stage">
        <div class="jf-container">
            <div class="jf-progress">
                <div class="jf-progress__label">
                    <span id="jf-progress-text">Pertanyaan 1 dari {{ count($questions) }}</span>
                    <span id="jf-progress-pct">5%</span>
                </div>
                <div class="jf-progress__track" id="jf-progress-track"></div>
            </div>

            <div id="jf-question-root"></div>

            <div class="jf-nav">
                <button type="button" id="jf-prev-btn" class="jf-btn jf-btn--ghost">&larr; Sebelumnya</button>
                <button type="button" id="jf-next-btn" class="jf-btn jf-btn--primary" disabled>Berikutnya</button>
            </div>
        </div>
    </section>

    {{-- STATE 2: Hasil (hidden sampai kuis selesai) --}}
    <section id="jurufind-result-stage" class="jf-stage" hidden>
        <div class="jf-container" id="jf-result-root">
            {{-- diisi penuh oleh JS setelah fetch /jurufind/analyze sukses --}}
        </div>
    </section>
</main>

<script>
    window.JURUFIND_QUESTIONS = @json($questions);
    window.JURUFIND_MAJORS = @json($majors);
</script>
<script src="{{ asset('assets/js/jurufind.js') }}" defer></script>
@endsection
```

> Kalau project ini belum punya `layouts/app.blade.php` yang generic (cek dulu!),
> jangan paksa `@extends` — buat full HTML document sendiri di file ini (ada
> `<meta name="csrf-token" content="{{ csrf_token() }}">` di `<head>`, WAJIB ada
> untuk request AJAX di §11).

## 11. JS — `public/assets/js/jurufind.js`

Vanilla JS, tanpa dependency eksternal apapun. Alur:

1. Render 1 pertanyaan pada satu waktu dari `window.JURUFIND_QUESTIONS`, opsi jawaban
   sebagai tombol (A/B/C/D). Simpan pilihan ke object `answers` (`{ [question_id]: option_id }`).
2. Tombol "Berikutnya" disabled sampai ada opsi dipilih untuk pertanyaan aktif.
3. Update progress bar (`#jf-progress-text`, `#jf-progress-pct`, `#jf-progress-track`)
   setiap pindah pertanyaan.
4. Di pertanyaan terakhir, tombol berubah jadi "Selesai" → saat diklik:
   - Disable tombol, tampilkan state loading (misal ganti teks jadi "Memproses...").
   - `fetch(app.dataset.analyzeUrl, { method: 'POST', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept':'application/json' }, body: JSON.stringify({ answers }) })`
     — `csrfToken` diambil dari `document.querySelector('meta[name="csrf-token"]').content`.
   - Kalau response tidak `ok` (network/500 error beneran, BUKAN validasi), tampilkan
     pesan error sederhana di halaman, jangan biarkan halaman blank.
   - Kalau sukses: sembunyikan `#jurufind-quiz-stage` (set `hidden`), tampilkan
     `#jurufind-result-stage`, render hasil ke `#jf-result-root` (lihat §12 untuk
     elemen apa saja yang perlu dirender).
5. Tombol "Sebelumnya" mundur satu pertanyaan, mempertahankan pilihan sebelumnya
   (tampilkan opsi yang sebelumnya dipilih ter-highlight).

Referensi struktur data yang diterima dari server setelah fetch sukses:

```json
{
  "scoring": {
    "majorPercentages": { "SIJA": 63, "TJAT": 37 },
    "primaryMajor": "SIJA",
    "difference": 26,
    "tier": "clear",
    "dimensionScores": { "programming": 9, "networking": 5, "...": "..." },
    "topDimensions": [{ "dimension": "programming", "score": 9 }, "..."]
  },
  "explanation": {
    "primaryMajor": "SIJA",
    "summary": "...",
    "reasons": ["...", "..."],
    "topInterests": [{ "name": "Programming", "score": 9 }],
    "comparison": "...",
    "fallback": false
  }
}
```

## 12. Konten halaman hasil (di-render oleh JS ke `#jf-result-root`)

Urutan section (mengikuti versi Next.js sebelumnya, ini SUDAH teruji UX-nya):

1. **Judul**: "Lebih condong ke {primaryMajor}" — warna teks sesuai jurusan
   (SIJA = biru `#2451ff`, TJAT = hijau `#0f8a5f`).
2. **Dua score bar** (SIJA % dan TJAT %, masing-masing progress bar horizontal).
3. **"Kenapa {primaryMajor}?"** — `explanation.summary`, lalu daftar `explanation.reasons`
   sebagai bullet list, lalu `explanation.comparison`. Kalau `explanation.fallback === true`,
   tampilkan catatan kecil italic: "Penjelasan AI sementara tidak tersedia. Persentase di
   atas tetap dihitung secara deterministik dari jawabanmu."
4. **"Minat kamu"** — render `scoring.topDimensions` sebagai bar horizontal pendek,
   label dari `window.JURUFIND_MAJORS`... sebenarnya label dimensi ada di
   `QuizData::dimensionLabels()` — **tambahkan juga** `window.JURUFIND_DIMENSION_LABELS
   = @json(\App\Services\Jurufind\QuizData::dimensionLabels())` di Blade (§10) supaya JS
   bisa translate key dimensi ke label yang enak dibaca.
5. **Disclaimer kecil**: "Ini hasil eksplorasi minat, bukan penentu jurusan yang pasti."
6. **Tombol aksi**: kalau `scoring.tier === 'close'` tampilkan DUA tombol (pelajari SIJA
   & pelajari TJAT, link ke halaman info jurusan masing-masing kalau sudah ada route-nya
   — cek dulu apakah sudah ada halaman detail jurusan di repo ini sebelum bikin link mati).
   Kalau tier bukan `'close'`, cukup satu tombol untuk `primaryMajor`.
   Tambahkan juga tombol "Ulangi Kuis" yang reload halaman (`location.reload()`).

## 13. CSS — `public/assets/css/jurufind.css`

Pakai CSS custom properties biar konsisten, TANPA framework CSS apapun (murni CSS):

```css
:root {
  --jf-bg: #f6f7f4;
  --jf-ink: #12181b;
  --jf-sija: #2451ff;
  --jf-sija-soft: #e5ebff;
  --jf-tjat: #0f8a5f;
  --jf-tjat-soft: #dff3e9;
  --jf-line: #d8dbd4;
  --jf-font-display: 'Space Grotesk', sans-serif;
  --jf-font-body: 'Inter', sans-serif;
}

.jurufind-app { background: var(--jf-bg); color: var(--jf-ink); font-family: var(--jf-font-body); min-height: 100vh; }
.jf-container { max-width: 640px; margin: 0 auto; padding: 3rem 1.5rem; }
.jf-progress__track { display: flex; gap: 4px; height: 6px; }
.jf-progress__track > div { flex: 1; background: var(--jf-line); border-radius: 999px; }
.jf-progress__track > div.filled { background: var(--jf-ink); }
/* ...lanjutkan styling: kartu pertanyaan, tombol opsi, score bar, dimension bar,
   tombol primary/ghost — pakai palet warna di atas, font display buat heading,
   font body buat teks biasa. Detail visual bebas menyesuaikan, yang penting
   konsisten sama dua warna brand (biru SIJA / hijau TJAT). */
```

Agent bebas melengkapi detail visual CSS-nya asal konsisten dengan token warna di atas
dan tetap readable/rapi di mobile (max-width container, padding cukup, kontras teks jelas).

## 14. Testing — `tests/Unit/Jurufind/`

Pakai PHPUnit (sudah ada `tests/Unit/ExampleTest.php` sebagai referensi konvensi).

`ScoringServiceTest.php` — minimal cover:
- Total `majorPercentages['SIJA'] + majorPercentages['TJAT']` selalu 100.
- Jawaban yang didominasi opsi ber-skor SIJA (programming/cloud/system_development)
  menghasilkan `primaryMajor === 'SIJA'`.
- Jawaban yang didominasi opsi ber-skor TJAT (fiber_optic/telecommunications/wireless)
  menghasilkan `primaryMajor === 'TJAT'`.
- `isComplete()` mengembalikan `false` kalau ada 1 pertanyaan yang belum terjawab.

`ResponseValidatorTest.php` — minimal cover:
- Array lengkap dan valid → `true`.
- Field wajib hilang (`summary`, `reasons`, dll) → `false`.
- `primaryMajor` di luar `SIJA`/`TJAT` → `false`.

## 15. Checklist penerimaan (acceptance criteria)

- [ ] `/jurufind/test` menampilkan 20 pertanyaan satu per satu dengan progress bar.
- [ ] Tombol "Berikutnya" disabled sebelum user memilih opsi.
- [ ] Setelah pertanyaan ke-20 dijawab dan diklik "Selesai", halaman menampilkan hasil
      TANPA reload/redirect, dalam satu halaman yang sama.
- [ ] Field `answers` yang dikirim ke server berisi jawaban mentah (option id), BUKAN
      skor yang sudah dihitung.
- [ ] `GRIPHUBROUTER_API_KEY` tidak pernah muncul di response JSON, di HTML, atau di
      Network tab browser manapun.
- [ ] Kalau `.env` sengaja dikosongkan `GRIPHUBROUTER_API_KEY`, halaman hasil TETAP
      tampil (pakai `FallbackExplanationBuilder`), tidak error 500.
- [ ] `php artisan test --filter=Jurufind` lulus semua.
- [ ] Route lain yang sudah ada di `routes/web.php` (home, ppdb, jurufind info, mitra
      industri) tidak berubah/rusak.

## 16. Batasan tegas — JANGAN lakukan ini

- Jangan tambahkan React/Vue/Alpine.js atau build tool baru untuk fitur ini.
- Jangan taruh logic scoring atau prompt AI di JS/Blade — semua di service class PHP.
- Jangan expose `GRIPHUBROUTER_API_KEY` ke response JSON atau ke `window.*` di Blade.
- Jangan hitung ulang/koreksi persentase di dalam prompt AI atau di JS — persentase
  final HANYA dari `ScoringService`.
- Jangan hapus atau modifikasi `resources/views/jurufind.blade.php` (halaman info,
  beda dari `jurufind/test.blade.php` yang baru).
- Jangan ubah `routes/web.php` selain MENAMBAHKAN dua route baru di §9.
