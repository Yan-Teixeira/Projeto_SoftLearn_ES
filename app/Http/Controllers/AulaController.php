<?php

namespace App\Http\Controllers;
use App\Models\Quiz;

class AulaController extends Controller
{
    public function aulaTeste()
    {
        $quiz = Quiz::with('questoes.opcoes')->first();
        return view('aulas.teste', compact('quiz'));
    }
}
