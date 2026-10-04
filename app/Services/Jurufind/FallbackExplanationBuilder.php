<?php

namespace App\Services\Jurufind;

class FallbackExplanationBuilder
{
    /** Dipakai kalau AI provider gagal/invalid — hasil tetap harus bisa ditampilkan. */
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
