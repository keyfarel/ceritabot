<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBot extends Component
{
    public $prompt = '';
    public $reply = '';
    public $isLoading = false;
    public $chatHistory = [];

    public function submit()
    {
        Log::info('⏳ Submit dipanggil', [
            'prompt' => $this->prompt,
            'chatHistorySebelum' => $this->chatHistory
        ]);

        Log::info('📌 Memulai validasi');

        $this->validate([
            'prompt' => 'required|min:5',
        ]);

        Log::info('✅ Validasi lolos');

        $this->isLoading = true;

        $this->chatHistory[] = [
            'role' => 'user',
            'content' => $this->prompt,
            'timestamp' => now()->toDateTimeString(),
        ];

        $messagesForApi = [];
        foreach ($this->chatHistory as $msg) {
            $messagesForApi[] = [
                'role' => $msg['role'],
                'content' => $msg['content'],
            ];
        }

        $payload = [
            'model' => 'llama3-70b-8192',
            'messages' => array_merge([
                [
                    'role' => 'system',
                    'content' => "Kamu adalah AI psikolog virtual yang sangat empatik, mendengarkan curhatan, dan merespons dengan bahasa yang lembut, penuh perhatian, serta dalam Bahasa Indonesia."
                ]
            ], $messagesForApi),
            'temperature' => 0.7,
            'max_tokens' => 500,
        ];

        Log::info('📤 Mengirim request ke API', ['payload' => $payload]);

        try {
            $response = Http::timeout(15)
                ->withToken(config('services.openai.key'))
                ->post('https://api.groq.com/openai/v1/chat/completions', $payload);

            if ($response->successful()) {
                $result = $response->json();

                Log::info('✅ Respon API berhasil', ['response' => $result]);

                $aiReply = $result['choices'][0]['message']['content'] ?? 'Maaf, saya belum bisa menjawab saat ini.';

                $this->chatHistory[] = [
                    'role' => 'assistant',
                    'content' => $aiReply,
                    'timestamp' => now()->toDateTimeString(),
                ];

                $this->reply = $aiReply;
            } else {
                Log::warning('⚠️ Respon API gagal', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                $this->reply = 'Terjadi kesalahan saat memproses permintaan.';
            }
        } catch (\Exception $e) {
            Log::error('❌ Exception terjadi saat request', ['message' => $e->getMessage()]);
            $this->reply = 'Terjadi kesalahan koneksi atau waktu tunggu ke server.';
        }

        Log::info('📦 Submit selesai', [
            'reply' => $this->reply,
            'chatHistorySesudah' => $this->chatHistory
        ]);

        $this->isLoading = false;
        $this->prompt = '';
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
