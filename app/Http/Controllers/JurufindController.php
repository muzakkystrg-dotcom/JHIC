<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyzeJurufindRequest;
use App\Services\Jurufind\ExplanationService;
use App\Services\Jurufind\QuizData;
use App\Services\Jurufind\ScoringService;
use Illuminate\Http\JsonResponse;
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

        return response()->json([
            'scoring' => $scoring,
            'explanation' => $explanation,
        ]);
    }
}
