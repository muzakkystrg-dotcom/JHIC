<?php

namespace Tests\Unit\Jurufind;

use App\Services\Jurufind\QuizData;
use App\Services\Jurufind\ScoringService;
use PHPUnit\Framework\TestCase;

class ScoringServiceTest extends TestCase
{
    private ScoringService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ScoringService;
    }

    /**
     * Bangun jawaban: untuk tiap pertanyaan pilih opsi dengan major tertentu.
     * Kalau $weight diberikan, utamakan opsi dengan bobot itu (fallback ke bobot apapun).
     */
    private function answersForMajor(string $major, ?int $weight = null): array
    {
        $answers = [];

        foreach (QuizData::questions() as $question) {
            $candidates = array_values(array_filter(
                $question['options'],
                fn (array $option) => $option['major'] === $major
            ));

            if ($weight !== null) {
                $preferred = array_values(array_filter(
                    $candidates,
                    fn (array $option) => $option['weight'] === $weight
                ));
                if ($preferred) {
                    $candidates = $preferred;
                }
            }

            // Ambil opsi dengan bobot tertinggi di antara kandidat.
            usort($candidates, fn (array $a, array $b) => $b['weight'] <=> $a['weight']);
            $answers[$question['id']] = $candidates[0]['id'];
        }

        return $answers;
    }

    /** Campuran bobot setara: separo pertanyaan jalur S, separo jalur T, bobot sama. */
    private function balancedAnswers(): array
    {
        $answers = [];
        $half = (int) (count(QuizData::questions()) / 2);

        foreach (QuizData::questions() as $index => $question) {
            $major = $index < $half ? 'S' : 'T';
            $picked = null;

            foreach ($question['options'] as $option) {
                if ($option['major'] === $major && $option['weight'] === 1) {
                    $picked = $option['id'];
                    break;
                }
            }
            if ($picked === null) {
                foreach ($question['options'] as $option) {
                    if ($option['major'] === $major) {
                        $picked = $option['id'];
                        break;
                    }
                }
            }

            $answers[$question['id']] = $picked;
        }

        return $answers;
    }

    public function test_all_highest_weight_sija_answers_give_sija_100(): void
    {
        $result = $this->service->score($this->answersForMajor('S'));

        $this->assertSame('SIJA', $result['primaryMajor']);
        $this->assertSame(100, $result['majorPercentages']['SIJA']);
        $this->assertSame(0, $result['majorPercentages']['TJAT']);
        $this->assertSame(24, $result['rawPoints']['SIJA']);
    }

    public function test_all_highest_weight_tjat_answers_give_tjat_100(): void
    {
        $result = $this->service->score($this->answersForMajor('T'));

        $this->assertSame('TJAT', $result['primaryMajor']);
        $this->assertSame(100, $result['majorPercentages']['TJAT']);
        $this->assertSame(0, $result['majorPercentages']['SIJA']);
        $this->assertSame(24, $result['rawPoints']['TJAT']);
    }

    public function test_balanced_answers_produce_close_tier(): void
    {
        $result = $this->service->score($this->balancedAnswers());

        $this->assertSame(0, $result['difference']);
        $this->assertSame('close', $result['tier']);
        $this->assertSame(50, $result['majorPercentages']['SIJA']);
        $this->assertSame(50, $result['majorPercentages']['TJAT']);
    }

    public function test_total_percentage_of_both_majors_is_always_100(): void
    {
        $answerSets = [
            [],
            $this->answersForMajor('S'),
            $this->answersForMajor('T'),
            $this->balancedAnswers(),
            ['q01' => 'a'],
        ];

        foreach ($answerSets as $answers) {
            $result = $this->service->score($answers);
            $percentages = $result['majorPercentages'];

            $this->assertSame(
                100,
                $percentages['SIJA'] + $percentages['TJAT'],
                'Total persentase SIJA + TJAT harus 100.'
            );
        }
    }

    public function test_difference_matches_the_gap_between_percentages(): void
    {
        $result = $this->service->score($this->answersForMajor('T'));

        $this->assertSame(
            abs($result['majorPercentages']['SIJA'] - $result['majorPercentages']['TJAT']),
            $result['difference']
        );
    }

    public function test_is_complete_is_false_when_one_question_is_unanswered(): void
    {
        $answers = $this->answersForMajor('S');
        unset($answers['q13']);

        $this->assertFalse($this->service->isComplete($answers));
        $this->assertCount(19, $answers);
    }

    public function test_is_complete_is_false_when_an_option_id_is_invalid(): void
    {
        $answers = $this->answersForMajor('S');
        $answers['q13'] = 'z';

        $this->assertFalse($this->service->isComplete($answers));
    }

    public function test_is_complete_is_true_for_a_full_valid_answer_set(): void
    {
        $this->assertTrue($this->service->isComplete($this->answersForMajor('S')));
    }
}
