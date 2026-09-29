<?php

namespace App\Services\Jurufind;

class ScoringService
{
    /**
     * @param  array<string,string>  $answers  [question_id => option_id]
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
            if ($i >= QuizData::TOP_DIMENSIONS_COUNT) {
                break;
            }
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
            if (! $selectedOptionId) {
                continue;
            }

            $option = collect($question['options'])->firstWhere('id', $selectedOptionId);
            if (! $option) {
                continue;
            }

            foreach ($option['scores'] as $dimension => $value) {
                $totals[$dimension] = ($totals[$dimension] ?? 0) + $value;
            }
        }

        return $totals;
    }

    private function classifyTier(int $difference): string
    {
        $thresholds = QuizData::nearTieThresholds();
        if ($difference <= $thresholds['close']) {
            return 'close';
        }
        if ($difference <= $thresholds['leaning']) {
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
