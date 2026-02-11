<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;

class AiTestController extends Controller
{
   public function test()
{
    $result = Gemini::generativeModel('gemini-2.5-flash')
        ->generateContent("Give me 5 short tasks for building a portfolio website. Return as bullet list.");

    return view('ai-test', [
        'text' => $result->text()
    ]);
}
}