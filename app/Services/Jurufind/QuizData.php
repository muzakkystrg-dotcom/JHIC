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
