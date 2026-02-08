<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class QuizController extends Controller
{
    public function show(string $slug, int $index = 0)
    {
        $quiz = Quiz::where('slug', $slug)
            ->with('questoes.opcoes')
            ->firstOrFail();

        $questao = $quiz->questoes[$index] ?? null;

        if (!$questao) {
            abort(404);
        }

        return view('quiz.question', [
            'quiz' => $quiz,
            'questao' => $questao,
            'index' => $index
        ]);
    }
}

