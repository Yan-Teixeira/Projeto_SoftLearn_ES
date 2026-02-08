<?php

namespace Database\Seeders;

use App\Models\Aulas;
use App\Models\Modulo;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    $modulo = Modulo::create([
        'titulo' => 'Engenharia de Software'
    ]);

    $aula = Aulas::create([
        'modulo_id' => $modulo->id,
        'titulo' => 'Introdução',
        'conteudo' => 'Aula introdutória'
    ]);

    $quiz = Quiz::create([
        'aula_id' => $aula->id,
        'titulo' => 'Quiz Introdução',
        'slug' => 'introducao',
        'dificuldade' => 'Médio'
    ]);

    $questoes = $quiz->questoes()->create([
        'enunciado' => 'O que é Engenharia de Software?',
        'dica' => 'Pense em processos'
    ]);

    $questoes->opcoes()->createMany([
        ['texto_opcao' => 'Uma linguagem', 'correta' => false],
        ['texto_opcao' => 'Uma disciplina da computação', 'correta' => true],
    ]);
    }

}