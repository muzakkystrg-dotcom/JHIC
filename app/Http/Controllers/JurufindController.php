<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyzeJurufindRequest;
use App\Services\Jurufind\ExplanationService;
use App\Services\Jurufind\QuizData;
use App\Services\Jurufind\ScoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'savedResult' => null,
            'isResultPage' => false,
        ]);
    }

    /** POST /jurufind/analyze — hitung skor + minta penjelasan AI (atau fallback). */
    public function analyze(AnalyzeJurufindRequest $request): JsonResponse
    {
        $answers = $request->validated()['answers'];

        if (! $this->scoringService->isComplete($answers)) {
            return response()->json([
                'error' => 'Belum semua pertanyaan terjawab.',
            ], 422);
        }

        $scoring = $this->scoringService->score($answers);
        $explanation = $this->explanationService->explain($scoring);

        // Simpan hasil di session supaya user bisa kembali ke halaman hasil
        // (mis. setelah melihat detail jurusan) tanpa mengulang tes dari awal.
        $request->session()->put('jurufind.result', [
            'scoring' => $scoring,
            'explanation' => $explanation,
            'completedAt' => now()->toIso8601String(),
        ]);

        return response()->json([
            'scoring' => $scoring,
            'explanation' => $explanation,
            'resultUrl' => route('jurufind.result'),
        ]);
    }

    /**
     * GET /jurufind/hasil — tampilkan kembali hasil tes terakhir dari session.
     * Kalau belum ada hasil tersimpan, arahkan ke halaman tes.
     */
    public function result(Request $request): View|RedirectResponse
    {
        $saved = $request->session()->get('jurufind.result');

        if (! is_array($saved) || ! isset($saved['scoring'], $saved['explanation'])) {
            return redirect()->route('jurufind.test');
        }

        return view('jurufind.test', [
            'questions' => QuizData::questions(),
            'majors' => QuizData::majors(),
            'savedResult' => $saved,
            'isResultPage' => true,
        ]);
    }
}
