<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;

class AiTestController extends Controller
{
    public function test()
    {
        // Use 'gemini-2.5-flash' for the stable, fast version
        $result = Gemini::generativeModel(model: 'gemini-2.5-flash')
            ->generateContent("Hello from Laravel! Say hi.");

        return $result->text();
    }
}