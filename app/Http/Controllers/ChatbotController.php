<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskChatbotRequest;
use App\Services\Chatbot\ChatbotService;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    public function __construct(private readonly ChatbotService $chatbotService) {}

    public function ask(AskChatbotRequest $request): JsonResponse
    {
        $history = $request->validated()['messages'];
        $reply = $this->chatbotService->reply($history);

        return response()->json(['reply' => $reply]);
    }
}
