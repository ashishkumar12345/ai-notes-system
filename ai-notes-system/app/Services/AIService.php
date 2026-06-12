<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    /**
     * Generate Summary
     */
    public function generateSummary(string $content): string
    {
        $response = Http::withToken($this->apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Summarize the note in 3-5 concise bullet points.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $content
                    ]
                ]
            ]);

        return $response->json()['choices'][0]['message']['content'] ?? '';
    }

    /**
     * Generate Embedding
     */
    public function generateEmbedding(string $text): array
    {
        $response = Http::withToken($this->apiKey)
            ->post('https://api.openai.com/v1/embeddings', [
                'model' => 'text-embedding-3-small',
                'input' => $text
            ]);

        return $response->json()['data'][0]['embedding'] ?? [];
    }
}