<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AiService
{
    public function generateText(string $prompt, int $maxTokens = 80): string
    {
        // 🔥 Temporary: Always use mock
        return $this->mockResponse();

        // ---- If you want toggle ----
        // if (config('services.ai.mock') === true) {
        //     return $this->mockResponse();
        // }
        
        // return $this->OpenAiCall($prompt, $maxTokens);
    }

    /**
     * 🔥 1) Hardcoded mock responses (AI-like)
     */
    private function mockResponse(): string
    {
        $responses = [
            "A deliciously crafted dish with bold flavors and perfect balance.",
            "A rich and aromatic recipe designed to delight every palate.",
            "A beautifully prepared meal featuring fresh ingredients and authentic taste.",
            "A flavorful dish that combines tradition with modern culinary finesse.",
            "A satisfying menu item crafted with premium ingredients and care.",
        ];

        return $responses[array_rand($responses)];
    }

    /**
     * 🧠 2) Real OpenAI call (for later use)
     */
    private function OpenAiCall(string $prompt, int $maxTokens = 80): string
    {
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => $maxTokens,
            ]);

            return $response->choices[0]->message->content ?? 'No response received.';
            
        } catch (\Throwable $e) {
            logger("OpenAI error: " . $e->getMessage());
            return "AI temporarily unavailable.";
        }
    }
}
