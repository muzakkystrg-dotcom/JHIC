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
     * Pilih, untuk setiap pertanyaan, opsi yang paling banyak menyumbang dimensi
     * yang diinginkan — dipakai supaya test tidak perlu hardcode 20 jawaban.
     */
    private function dominantAnswers(array $preferredDimensions): array
    {
        $answers = [];

        foreach (QuizData::questions() as $question) {
            $bestOptionId = null;
            $bestScore = -1;

            foreach ($question['options'] as $option) {
                $score = 0;
                foreach ($option['scores'] as $dimension => $value) {
                    if (in_array($dimension, $preferredDimensions, true)) {
                        $score += $value;
                    }
                }

                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestOptionId = $option['id'];
                }
            }

            $answers[$question['id']] = $bestOptionId;
        }

        return $answers;
    }

    public function test_total_percentage_of_both_majors_is_always_100(): void
    {
        $answerSets = [
            [],
            $this->dominantAnswers(['programming', 'cloud', 'system_development']),
            $this->dominantAnswers(['fiber_optic', 'telecommunications', 'wireless']),
            $this->dominantAnswers(['iot', 'hands_on', 'cybersecurity']),
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

    public function test_answers_dominated_by_sija_dimensions_recommend_sija(): void
    {
        $answers = $this->dominantAnswers(['programming', 'cloud', 'system_development']);

        $result = $this->service->score($answers);

        $this->assertSame('SIJA', $result['primaryMajor']);
        $this->assertGreaterThan($result['majorPercentages']['TJAT'], $result['majorPercentages']['SIJA']);
        $this->assertContains($result['tier'], ['close', 'leaning', 'clear']);
    }

    public function test_answers_dominated_by_tjat_dimensions_recommend_tjat(): void
    {
        $answers = $this->dominantAnswers(['fiber_optic', 'telecommunications', 'wireless']);

        $result = $this->service->score($answers);

        $this->assertSame('TJAT', $result['primaryMajor']);
        $this->assertGreaterThan($result['majorPercentages']['SIJA'], $result['majorPercentages']['TJAT']);
    }

    public function test_difference_matches_the_gap_between_percentages(): void
    {
        $result = $this->service->score($this->dominantAnswers(['fiber_optic', 'telecommunications']));

        $this->assertSame(
            abs($result['majorPercentages']['SIJA'] - $result['majorPercentages']['TJAT']),
            $result['difference']
        );
    }

    public function test_top_dimensions_are_limited_and_sorted_descending(): void
    {
        $result = $this->service->score($this->dominantAnswers(['programming', 'cloud', 'networking']));

        $this->assertCount(QuizData::TOP_DIMENSIONS_COUNT, $result['topDimensions']);

        $scores = array_column($result['topDimensions'], 'score');
        $sorted = $scores;
        rsort($sorted);
        $this->assertSame($sorted, $scores);

        foreach ($result['topDimensions'] as $top) {
            $this->assertArrayHasKey('dimension', $top);
            $this->assertArrayHasKey('score', $top);
        }
    }

    public function test_is_complete_is_false_when_one_question_is_unanswered(): void
    {
        $answers = $this->dominantAnswers(['programming']);
        unset($answers['q13']);

        $this->assertFalse($this->service->isComplete($answers));
        $this->assertCount(19, $answers);
    }

    public function test_is_complete_is_false_when_an_option_id_is_invalid(): void
    {
        $answers = $this->dominantAnswers(['programming']);
        $answers['q13'] = 'z';

        $this->assertFalse($this->service->isComplete($answers));
    }

    public function test_is_complete_is_true_for_a_full_valid_answer_set(): void
    {
        $this->assertTrue($this->service->isComplete($this->dominantAnswers(['programming'])));
    }
}
