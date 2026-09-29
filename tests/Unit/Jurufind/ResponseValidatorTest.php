<?php

namespace Tests\Unit\Jurufind;

use App\Services\Jurufind\ResponseValidator;
use PHPUnit\Framework\TestCase;

class ResponseValidatorTest extends TestCase
{
    private function validPayload(): array
    {
        return [
            'primaryMajor' => 'SIJA',
            'summary' => 'Hasilmu lebih condong ke SIJA.',
            'reasons' => ['Kamu suka ngoding.', 'Kamu nyaman mengatur server.'],
            'topInterests' => [
                ['name' => 'Programming', 'score' => 9],
                ['name' => 'Cloud', 'score' => 6],
            ],
            'comparison' => 'SIJA lebih kuat di sisi aplikasi, TJAT di sisi jaringan akses.',
        ];
    }

    public function test_complete_valid_payload_passes(): void
    {
        $this->assertTrue(ResponseValidator::isValid($this->validPayload()));
    }

    public function test_payload_with_tjat_primary_major_passes(): void
    {
        $payload = $this->validPayload();
        $payload['primaryMajor'] = 'TJAT';

        $this->assertTrue(ResponseValidator::isValid($payload));
    }

    public function test_numeric_string_score_is_accepted(): void
    {
        $payload = $this->validPayload();
        $payload['topInterests'] = [['name' => 'Fiber Optic', 'score' => '7']];

        $this->assertTrue(ResponseValidator::isValid($payload));
    }

    public function test_empty_reasons_list_passes(): void
    {
        $payload = $this->validPayload();
        $payload['reasons'] = [];

        $this->assertTrue(ResponseValidator::isValid($payload));
    }

    public function test_non_array_input_is_rejected(): void
    {
        $this->assertFalse(ResponseValidator::isValid('bukan array'));
        $this->assertFalse(ResponseValidator::isValid(null));
    }

    public function test_missing_summary_is_rejected(): void
    {
        $payload = $this->validPayload();
        unset($payload['summary']);

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_blank_summary_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['summary'] = '   ';

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_missing_reasons_is_rejected(): void
    {
        $payload = $this->validPayload();
        unset($payload['reasons']);

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_non_string_reason_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['reasons'] = ['alasan valid', 42];

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_missing_top_interests_is_rejected(): void
    {
        $payload = $this->validPayload();
        unset($payload['topInterests']);

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_top_interest_without_name_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['topInterests'] = [['score' => 5]];

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_top_interest_with_non_numeric_score_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['topInterests'] = [['name' => 'IoT', 'score' => 'tinggi']];

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_missing_comparison_is_rejected(): void
    {
        $payload = $this->validPayload();
        unset($payload['comparison']);

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_primary_major_outside_sija_and_tjat_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['primaryMajor'] = 'TKJ';

        $this->assertFalse(ResponseValidator::isValid($payload));
    }

    public function test_null_primary_major_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['primaryMajor'] = null;

        $this->assertFalse(ResponseValidator::isValid($payload));
    }
}
