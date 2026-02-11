<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;

class AiService
{
    public function generateTasks(string $projectName, string $description = null)
    {
        $prompt ="Generate exactly 5 short actionable tasks.Return ONLY plain task lines.No numbering.No explanation.
: {$projectName}. {$description}";

        $response = Gemini::generativeModel('gemini-2.5-flash')
            ->generateContent($prompt);

        return $response->text();
    }
}