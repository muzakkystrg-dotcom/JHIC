<?php

namespace App\Services\Jurufind;

class ScoringService
{
    /**
     * Tally langsung S (SIJA) vs T (TJAT), tanpa bobot dimensi apapun.
     *
     * @param  array<string,string>  $answers  [question_id => option_id]
     * @return array{
     *   majorPercentages: array{SIJA:int,TJAT:int},
     *   primaryMajor: string,
     *   difference: int,
     *   tier: string,
     *   rawPoints: array{SIJA:int,TJAT:int}
     * }
     */
    public function score(array $answers): array
    {
        $points = ['SIJA' => 0, 'TJAT' => 0];

        foreach (QuizData::questions() as $question) {
            $selectedId = $answers[$question['id']] ?? null;
            if (! $selectedId) {
                continue;
            }

            $option = collect($question['options'])->firstWhere('id', $selectedId);
            if (! $option) {
                continue;
            }

            $major = $option['major'] === 'S' ? 'SIJA' : 'TJAT';
            $points[$major] += $option['weight'];
        }

        $total = $points['SIJA'] + $points['TJAT'];

        $sijaPct = $total > 0 ? (int) round(($points['SIJA'] / $total) * 100) : 50;
        $tjatPct = 100 - $sijaPct;
        if ($tjatPct < 0) {
            $tjatPct = 0;
            $sijaPct = 100;
        }

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
        if ($difference <= $t['close']) {
            return 'close';
        }
        if ($difference <= $t['leaning']) {
            return 'leaning';
        }

        return 'clear';
    }

    /** True kalau semua 20 pertanyaan sudah terjawab dengan option id yang valid. */
    public function isComplete(array $answers): bool
    {
        foreach (QuizData::questions() as $question) {
            $selected = $answers[$question['id']] ?? null;
            if (! $selected) {
                return false;
            }
            $valid = collect($question['options'])->pluck('id')->contains($selected);
            if (! $valid) {
                return false;
            }
        }

        return true;
    }
}
