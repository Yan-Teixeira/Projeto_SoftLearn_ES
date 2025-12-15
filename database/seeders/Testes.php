<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aula_modulos;
use App\Models\Lesson;


class Testes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cria o Módulo Principal
        $moduleUML = Aula_modulos::firstOrCreate([
            'titulo' => 'Introdução à UML',
        ], [
            'titulo' => 'Introdução à UML',
            'descricao' => 'Aprenda os conceitos básicos da Unified Modeling Language (UML) e sua aplicação em projetos de software.',
        ]);

        // 2. Cria as Lições (Aulas) associadas a este Módulo
        Lesson::firstOrCreate([
            'module_id' => $moduleUML->id,
            'ordem' => 1,
        ], [
            'module_id' => $moduleUML->id,
            'titulo' => 'Conceitos Fundamentais e História',
            'conteudo' => '<p>UML é uma linguagem de modelagem gráfica que padroniza o design de sistemas de software. Foi criada para unificar os métodos de modelagem orientados a objetos.</p>',
            'ordem' => 1,
        ]);

        Lesson::firstOrCreate([
            'module_id' => $moduleUML->id,
            'ordem' => 2,
        ], [
            'module_id' => $moduleUML->id,
            'titulo' => 'Diagrama de Classes: A Estrutura',
            'conteudo' => 'O Diagrama de Classes é o principal diagrama de estrutura estática. Ele mostra a estrutura das classes do sistema, seus atributos, operações e os relacionamentos entre os objetos.',
            'ordem' => 2,
        ]);

        Lesson::firstOrCreate([
            'module_id' => $moduleUML->id,
            'ordem' => 3,
        ], [
            'module_id' => $moduleUML->id,
            'titulo' => 'Diagrama de Casos de Uso: O Comportamento',
            'conteudo' => 'O Diagrama de Casos de Uso descreve o que um sistema faz do ponto de vista do usuário (ator). Ele captura os requisitos funcionais do sistema.',
            'ordem' => 3,
        ]);
        
        // Exemplo de Outro Módulo
        $moduleDFD = Aula_modulos::firstOrCreate([
            'titulo' => 'Fundamentos de DFD',
        ], [
            'titulo' => 'Fundamentos de DFD',
            'descricao' => 'Domine o Diagrama de Fluxo de Dados (DFD) para mapear o fluxo de informação.',
        ]);
        
        Lesson::firstOrCreate([
            'module_id' => $moduleDFD->id,
            'ordem' => 1,
        ], [
            'module_id' => $moduleDFD->id,
            'titulo' => 'Elementos Básicos do DFD',
            'conteudo' => 'Entidades externas, processos, armazenamento de dados e fluxo de dados. Entenda como cada um interage.',
            'ordem' => 1,
        ]);
    }
}