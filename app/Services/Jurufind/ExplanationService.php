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
            Log::warning('[Jurufind] Falling back to deterministic explanation: '.$e->getMessage());

            return FallbackExplanationBuilder::build($scoring);
        }
    }

    private function callProvider(array $scoring): array
    {
        $apiKey = config('services.griphubrouter.key');
        if (! $apiKey) {
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
            throw new ProviderException('GripHubRouter request failed: '.$e->getMessage());
        }

        if ($response->failed()) {
            $detail = $response->json('error.message') ?? $response->json('message') ?? $response->body();
            throw new ProviderException("GripHubRouter responded with status {$response->status()}: {$detail}");
        }

        $text = $response->json('choices.0.message.content');
        if (! $text) {
            throw new ProviderException('GripHubRouter response had no message content.');
        }

        $parsed = json_decode($this->stripCodeFence($text), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ProviderException('GripHubRouter response was not valid JSON.');
        }

        if (! ResponseValidator::isValid($parsed)) {
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

        $shape = <<<'SHAPE'
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
