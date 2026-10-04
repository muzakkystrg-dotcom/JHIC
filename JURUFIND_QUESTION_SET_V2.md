# Spec: Ganti Soal Jurufind + Perbaiki Scoring yang Berat Sebelah

## 0. Konteks & akar masalah

Soal kuis diganti total dari model **12-dimensi-minat-berbobot** jadi model
**tally langsung S (SIJA) vs T (TJAT)** dengan bobot per-opsi (+1 atau +2).

**Kenapa hasil lama berat sebelah:** `ScoringService` versi lama mengalikan skor
dimensi dengan `MAJOR_DIMENSION_WEIGHTS` di `QuizData::majorDimensionWeights()` —
SIJA punya bobot ≥0.75 di 7 dari 12 dimensi, TJAT cuma di 5. Jadi meskipun
soal-soalnya keliatan seimbang, hasil akhirnya struktural condong ke SIJA.

**Kenapa soal baru ini otomatis fix:** tiap soal selalu punya persis 2 opsi
berbobot S dan 2 opsi berbobot T, dan total poin maksimum yang bisa dicapai
kedua jurusan **sama persis (24 poin masing-masing** kalau selalu pilih opsi
berbobot tertinggi). Jadi scoring-nya diganti jadi **tally murni tanpa
perkalian bobot dimensi apapun** — simetris by design, bukan ditambal manual.

Ini artinya `MAJOR_DIMENSION_WEIGHTS`, `dimensionScores`, `topDimensions`, dan
section "Minat kamu" di halaman hasil **dihapus semua** — model datanya nggak
mendukung itu lagi, dan desain hasil yang baru (sesuai mockup terakhir) memang
nggak ada section itu.

## 1. File yang diubah

```text
app/Services/Jurufind/QuizData.php                  -> ganti questions(), hapus majorDimensionWeights() & dimensionLabels()
app/Services/Jurufind/ScoringService.php             -> ganti total algoritma score()
app/Services/Jurufind/ExplanationService.php         -> update payload prompt (hapus 'dimensions')
app/Services/Jurufind/ResponseValidator.php          -> hapus validasi topInterests
app/Services/Jurufind/FallbackExplanationBuilder.php -> hapus logic topInterests dari dimensionScores
public/assets/js/jurufind.js                         -> hapus buildDimensions(), hapus pemakaian JURUFIND_DIMENSION_LABELS
resources/views/jurufind/test.blade.php              -> hapus baris window.JURUFIND_DIMENSION_LABELS kalau ada
tests/Unit/Jurufind/ScoringServiceTest.php            -> update assertion ke model tally baru
tests/Unit/Jurufind/ResponseValidatorTest.php         -> update ke schema baru (tanpa topInterests)
```

## 2. `app/Services/Jurufind/QuizData.php` — ganti total

Format option berubah dari `'scores' => [...]` (banyak dimensi) jadi
`'major' => 'S'|'T'` + `'weight' => 1|2` (satu nilai langsung).

```php
<?php

namespace App\Services\Jurufind;

class QuizData
{
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
            ],
            'TJAT' => [
                'id' => 'TJAT',
                'fullName' => 'Teknik Jaringan Akses Telekomunikasi',
                'shortName' => 'TJAT',
                'duration' => '3 tahun',
                'intro' => 'Kamu memiliki ketertarikan yang kuat pada kerja teknis langsung dan infrastruktur fisik — dari kabel, perangkat jaringan, sampai instalasi lapangan. Dengan potensi ini, jurusan TJAT adalah pilihan yang sangat cocok untuk mengasah keahlian teknismu.',
            ],
        ];
    }

    public static function nearTieThresholds(): array
    {
        return ['close' => 10, 'leaning' => 20]; // >20 = 'clear'
    }
}
```

> Teks `intro` di atas aku sesuaikan supaya nadanya mirip summary card di mockup
> ("Kamu memiliki ketertarikan yang kuat..."). Ganti sesuai selera kamu — ini
> cuma dipakai sebagai konteks tambahan buat prompt AI, bukan ditampilkan
> verbatim di hasil (yang ditampilkan verbatim adalah `explanation.summary`
> yang digenerate AI).

> **Kalau nanti mau konten lebih kaya** (reasons yang nyebut mata pelajaran
> spesifik dsb), tinggal expand field `intro` ini dengan ringkasan dari isi
> `pages/sija.blade.php` / `pages/tjat.blade.php` yang udah ada — supaya nggak
> ada data yang kontradiksi antara halaman detail jurusan dan hasil kuis.

## 3. `app/Services/Jurufind/ScoringService.php` — ganti total

```php
<?php

namespace App\Services\Jurufind;

class ScoringService
{
    /**
     * @param array<string,string> $answers  [question_id => option_id]
     */
    public function score(array $answers): array
    {
        $points = ['SIJA' => 0, 'TJAT' => 0];

        foreach (QuizData::questions() as $question) {
            $selectedId = $answers[$question['id']] ?? null;
            if (!$selectedId) continue;

            $option = collect($question['options'])->firstWhere('id', $selectedId);
            if (!$option) continue;

            $major = $option['major'] === 'S' ? 'SIJA' : 'TJAT';
            $points[$major] += $option['weight'];
        }

        $total = $points['SIJA'] + $points['TJAT'];

        $sijaPct = $total > 0 ? (int) round(($points['SIJA'] / $total) * 100) : 50;
        $tjatPct = 100 - $sijaPct;
        if ($tjatPct < 0) { $tjatPct = 0; $sijaPct = 100; }

        $primaryMajor = $sijaPct >= $tjatPct ? 'SIJA' : 'TJAT';
        $difference = abs($sijaPct - $tjatPct);
        $tier = $this->classifyTier($difference);

        return [
            'majorPercentages' => ['SIJA' => $sijaPct, 'TJAT' => $tjatPct],
            'primaryMajor' => $primaryMajor,
            'difference' => $difference,
            'tier' => $tier,
            'rawPoints' => $points, // opsional, berguna buat debugging
        ];
    }

    private function classifyTier(int $difference): string
    {
        $t = QuizData::nearTieThresholds();
        if ($difference <= $t['close']) return 'close';
        if ($difference <= $t['leaning']) return 'leaning';
        return 'clear';
    }

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

## 4. `app/Services/Jurufind/ResponseValidator.php` — hapus validasi `topInterests`

```php
<?php

namespace App\Services\Jurufind;

class ResponseValidator
{
    public static function isValid(mixed $data): bool
    {
        if (!is_array($data)) return false;
        if (!in_array($data['primaryMajor'] ?? null, ['SIJA', 'TJAT'], true)) return false;
        if (!is_string($data['summary'] ?? null) || trim($data['summary']) === '') return false;

        if (!is_array($data['reasons'] ?? null)) return false;
        foreach ($data['reasons'] as $reason) {
            if (!is_string($reason)) return false;
        }

        if (!is_string($data['comparison'] ?? null)) return false;

        return true;
    }
}
```

## 5. `app/Services/Jurufind/FallbackExplanationBuilder.php` — hapus `topInterests`

```php
<?php

namespace App\Services\Jurufind;

class FallbackExplanationBuilder
{
    public static function build(array $scoring): array
    {
        $primaryMajor = $scoring['primaryMajor'];
        $difference = $scoring['difference'];

        $summary = $difference <= 10
            ? "Berdasarkan hasil kuis, jawabanmu menunjukkan kecocokan dengan SIJA dan TJAT, tetapi sedikit lebih condong ke {$primaryMajor}. Penjelasan AI sementara tidak tersedia."
            : "Berdasarkan hasil kuis, jawabanmu lebih condong ke {$primaryMajor}. Penjelasan AI sementara tidak tersedia.";

        return [
            'primaryMajor' => $primaryMajor,
            'summary' => $summary,
            'reasons' => ["Skor kamu untuk {$primaryMajor} lebih tinggi dibanding pilihan lainnya berdasarkan jawabanmu di kuis."],
            'comparison' => 'Detail perbandingan minat antar jurusan belum bisa ditampilkan karena penjelasan AI sedang tidak tersedia.',
            'fallback' => true,
        ];
    }
}
```

## 6. `app/Services/Jurufind/ExplanationService.php` — update bagian prompt saja

Di method `buildPrompt()`, ganti bagian `$payload` (hapus key `dimensions`) dan
`$shape` (hapus `topInterests`). **Bagian lain (HTTP call ke GripHubRouter,
`stripCodeFence()`, error handling) TIDAK berubah, jangan disentuh.**

```php
$payload = [
    'majorScores' => $scoring['majorPercentages'],
    'difference' => $scoring['difference'],
    'primaryMajor' => $scoring['primaryMajor'],
];

$shape = <<<SHAPE
{
  "primaryMajor": "SIJA" | "TJAT",
  "summary": string,
  "reasons": string[],
  "comparison": string
}
SHAPE;
```

Prompt text lain (aturan near-tie, larangan hitung ulang persentase, dll) tetap
sama persis seperti sebelumnya.

## 7. `public/assets/js/jurufind.js` — hapus bagian dimensi

- Hapus function `buildDimensions()` sepenuhnya.
- Di `renderResult()`, hapus blok:
  ```js
  const dimensions = buildDimensions(scoring);
  if (dimensions) { ... }
  ```
- Hapus baris `const dimensionLabels = window.JURUFIND_DIMENSION_LABELS || {};`
  di bagian atas kalau ada.
- Semua bagian lain (progress bar, render pertanyaan, submit, score bars,
  actions) **tidak berubah** — struktur `scoring.majorPercentages`,
  `scoring.primaryMajor`, `scoring.difference`, `scoring.tier` masih persis
  sama bentuknya.

## 8. `resources/views/jurufind/test.blade.php`

Cari dan hapus baris ini kalau ada (sisa dari spec versi lama):
```blade
window.JURUFIND_DIMENSION_LABELS = @json(...)
```
Baris `window.JURUFIND_QUESTIONS` dan `window.JURUFIND_MAJORS` tetap
dipertahankan, cuma datanya sekarang otomatis ikut format baru dari
`QuizData::questions()`/`majors()`.

## 9. Update test — `tests/Unit/Jurufind/`

`ScoringServiceTest.php` — ganti assertion lama yang berbasis dimensi jadi:
- Jawab semua opsi `major=S` tertinggi → `primaryMajor === 'SIJA'` dan
  `majorPercentages['SIJA'] === 100` (karena TJAT dapat 0 poin).
- Jawab semua opsi `major=T` tertinggi → sebaliknya.
- Campuran 10 jawaban S + 10 jawaban T dengan bobot setara → `difference`
  mendekati 0, `tier === 'close'`.
- `majorPercentages['SIJA'] + majorPercentages['TJAT'] === 100` selalu.

`ResponseValidatorTest.php` — hapus semua test case yang menguji field
`topInterests` (field itu udah nggak ada di schema).

## 10. Checklist

- [ ] 20 soal baru tampil sesuai urutan & teks di atas (tanpa tag `(T+2)` dkk
      ikut ketampil ke user — itu cuma metadata, bukan bagian dari label).
- [ ] Jawab kuis dengan semua opsi "jalur software" → hasil SIJA tinggi, TJAT rendah.
- [ ] Jawab kuis dengan semua opsi "jalur teknis" → sebaliknya.
- [ ] Jawab campuran merata → hasil mendekati 50/50, tier `close`.
- [ ] Halaman hasil tidak lagi menampilkan section "Minat kamu" / dimension bar.
- [ ] `php artisan test --filter=Jurufind` lulus semua dengan assertion baru.
- [ ] `GRIPHUBROUTER_API_KEY` kosong → tetap jalan pakai fallback, tidak error 500.
