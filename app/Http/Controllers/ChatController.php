<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function chat(Request $request)
    {
        $prompt = $request->input('prompt');

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama3-70b-8192',
            'messages' => [
                ['role' => 'system', 'content' => 'Kamu adalah AI yang ramah, empatik, dan mendengarkan keluh kesah user dengan lembut.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

        $result = $response->json();
        $reply = $result['choices'][0]['message']['content'] ?? 'Maaf, aku tidak bisa menjawab sekarang.';

        return view('chat', compact('prompt', 'reply'));
    }
}
