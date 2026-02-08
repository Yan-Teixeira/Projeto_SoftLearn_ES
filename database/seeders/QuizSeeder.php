<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;
use App\Models\Aulas;
use App\Models\Quiz;
use App\Models\Questao;
use App\Models\Opcoes;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $data = config('quiz');

        // Módulo fixo (exemplo)
        $modulo = Modulo::firstOrCreate([
            'titulo' => 'Engenharia de Software'
        ]);

        foreach ($data as $key => $moduleData) {

            // Aula
            $aula = Aulas::firstOrCreate([
                'modulo_id' => $modulo->id,
                'titulo' => $moduleData['titulo']
            ]);

            // Quiz
            $quiz = Quiz::firstOrCreate([
                'aula_id' => $aula->id,
                'titulo' => 'Quiz - ' . $moduleData['titulo']
            ]);

            foreach ($moduleData['perguntas'] as $p) {

                // Questão
                $questoes = Questao::create([
                    'quiz_id' => $quiz->id,
                    'enunciado' => $p['pergunta'],
                    'dica' => null
                ]);

                // Opções
                foreach ($p['alternativas'] as $letra => $texto) {
                    Opcoes::create([
                        'questao_id' => $questoes->id,
                        'texto_opcao' => $texto,
                        'correta' => $letra === $p['correta']
                    ]);
                }
            }
        }
    }
}
