<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $modules = config('quiz');

        return view('quiz.index', compact('modules'));
    }

    public function question($module, $index)
    {
        $quiz = config("quiz.$module");

        $question = $quiz['perguntas'][$index] ?? null;

        return view('quiz.question', [
            'module' => $module,
            'quiz' => $quiz,
            'question' => $question,
            'index' => $index
        ]);
    }
}
