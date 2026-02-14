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

    public function improveTask($projectName, $projectDescription, $taskTitle)
    {
        $prompt = "
    You are improving a task for a project.

    Project: $projectName
    Description: $projectDescription

    Original task:
    \"$taskTitle\"

    Rewrite it into ONE short, clear, actionable task sentence.

    Rules:
    - Return ONLY the improved task
    - No explanations
    - No lists
    - No markdown
    - Max 20 words
    ";

        $result = Gemini::generativeModel('gemini-2.5-flash')
            ->generateContent($prompt);

        return trim($result->text());
    }
}