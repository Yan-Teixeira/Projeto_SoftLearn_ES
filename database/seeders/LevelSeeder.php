<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        // 1. Limpeza segura do banco de dados
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // MySQL
        } catch (\Exception $e) {
            try {
                DB::statement('PRAGMA foreign_keys = OFF;'); // SQLite
            } catch (\Exception $e2) {}
        }

        Level::truncate();

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // MySQL
        } catch (\Exception $e) {
            try {
                DB::statement('PRAGMA foreign_keys = ON;'); // SQLite
            } catch (\Exception $e2) {}
        }

        $levels = [];

        // Temas variados para garantir diversidade nos níveis.
        // Estrutura: [Ator1, Ator2, Ator3, Ator4, Ator5, Caso1, Caso2, Caso3, Caso4, Caso5, Caso6]
        // Garanti que cada array tenha pelo menos 5 atores e 6 casos de uso para não dar erro de índice.
        $themes = [
            'Hospital' => [
                'Médico', 'Enfermeiro', 'Paciente', 'Recepcionista', 'Farmacêutico', 
                'Agendar Consulta', 'Prescrever Medicamento', 'Realizar Triagem', 'Internar Paciente', 'Faturar Consulta', 'Alta Médica'
            ],
            'Aeroporto' => [
                'Piloto', 'Comissário', 'Passageiro', 'Controlador', 'Agente', 
                'Decolar', 'Pousar', 'Fazer Check-in', 'Despachar Mala', 'Controlar Tráfego', 'Embarcar'
            ],
            'E-commerce' => [
                'Cliente', 'Vendedor', 'Admin', 'Entregador', 'Suporte', 
                'Fazer Pedido', 'Cadastrar Produto', 'Gerenciar Estoque', 'Realizar Entrega', 'Atender Cliente', 'Devolver'
            ],
            'Biblioteca' => [
                'Leitor', 'Bibliotecário', 'Estudante', 'Professor', 'Visitante', 
                'Emprestar Livro', 'Devolver Livro', 'Reservar Sala', 'Catalogar Livro', 'Pagar Multa', 'Renovar'
            ],
            'Banco' => [
                'Correntista', 'Gerente', 'Caixa', 'Auditor', 'Segurança', 
                'Sacar Dinheiro', 'Abrir Conta', 'Investir', 'Auditar Transações', 'Monitorar Câmeras', 'Pedir Empréstimo'
            ],
            'Escola' => [
                'Aluno', 'Professor', 'Diretor', 'Coordenador', 'Pais', 
                'Assistir Aula', 'Lançar Notas', 'Gerenciar Turmas', 'Agendar Reunião', 'Matricular Aluno', 'Gerar Boletim'
            ],
            'Restaurante' => [
                'Cliente', 'Garçom', 'Cozinheiro', 'Gerente', 'Entregador', 
                'Fazer Pedido', 'Preparar Prato', 'Servir Mesa', 'Fechar Conta', 'Entregar Delivery', 'Comprar Insumos'
            ],
            'Cinema' => [
                'Espectador', 'Bilheteiro', 'Projacionista', 'Gerente', 'Faxineiro', 
                'Comprar Ingresso', 'Validar Entrada', 'Projetar Filme', 'Vender Pipoca', 'Limpar Sala', 'Exibir Trailer'
            ],
            'Hotel' => [
                'Hóspede', 'Recepcionista', 'Camareira', 'Gerente', 'Mensageiro', 
                'Fazer Check-in', 'Limpar Quarto', 'Pedir Serviço', 'Fazer Check-out', 'Levar Bagagem', 'Reservar Quarto'
            ],
            'Fábrica' => [
                'Operário', 'Supervisor', 'Engenheiro', 'Logística', 'Diretor', 
                'Operar Máquina', 'Supervisionar', 'Projetar Peça', 'Estocar Produto', 'Gerenciar Produção', 'Manutenção'
            ]
        ];

        $themeKeys = array_keys($themes);

        // Geração de 200 níveis
        for ($i = 1; $i <= 200; $i++) {
            $themeKey = $themeKeys[array_rand($themeKeys)];
            $data = $themes[$themeKey];
            $systemName = "Sistema " . $themeKey;

            // Determina a complexidade (1 a 5)
            $difficulty = ceil($i / 40); 

            // Separa Atores (índices 0-4) e Casos de Uso (índices 5-10)
            // Isso evita o erro de índice "Undefined array key"
            $availableActors = array_slice($data, 0, 5);
            $availableUseCases = array_slice($data, 5);

            // Seleção baseada na dificuldade
            // Garante que não tente pegar mais do que existe
            $numActors = min($difficulty + 1, count($availableActors));
            $numUseCases = min($difficulty + 2, count($availableUseCases));

            $actors = array_slice($availableActors, 0, $numActors); 
            $useCases = array_slice($availableUseCases, 0, $numUseCases); 

            $levelData = [
                'title' => "Nível $i: $themeKey - Fase $difficulty",
                'description' => "",
                'validation_rules' => [
                    'required_nodes' => [],
                    'required_groups' => [],
                    'required_connections' => []
                ]
            ];

            $desc = "Modele o <strong>'$systemName'</strong>. ";
            
            // Adiciona Atores Requeridos
            foreach ($actors as $actor) {
                $levelData['validation_rules']['required_nodes'][] = ['name' => $actor, 'type' => 'actor'];
            }
            // Adiciona Sistema Requerido
            $levelData['validation_rules']['required_nodes'][] = ['name' => $systemName, 'type' => 'system'];

            // Lógica de Conexões e Regras baseada na Dificuldade
            if ($difficulty == 1) {
                // Nível 1: Associações Simples
                $desc .= "Os atores <strong>'" . implode("'</strong> e <strong>'", $actors) . "'</strong> interagem com o sistema. ";
                $desc .= "O ator <strong>'{$actors[0]}'</strong> deve realizar o caso <strong>'{$useCases[0]}'</strong>. ";
                $desc .= "O ator <strong>'{$actors[1]}'</strong> deve realizar o caso <strong>'{$useCases[1]}'</strong>.";

                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[0], 'type' => 'usecase'];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[1], 'type' => 'usecase'];
                
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[0], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[1], 'outer' => $systemName];

                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[0], 'to' => $useCases[0], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[1], 'to' => $useCases[1], 'type' => 'Association'];

            } elseif ($difficulty == 2) {
                // Nível 2: Includes
                $desc .= "O caso <strong>'{$useCases[0]}'</strong> (feito por <strong>'{$actors[0]}'</strong>) deve INCLUIR obrigatoriamente o caso <strong>'{$useCases[2]}'</strong>. ";
                $desc .= "O ator <strong>'{$actors[1]}'</strong> realiza <strong>'{$useCases[1]}'</strong>.";

                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[0]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[1]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[2]]; 

                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[0], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[1], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[2], 'outer' => $systemName];

                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[0], 'to' => $useCases[0], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $useCases[0], 'to' => $useCases[2], 'type' => 'Include'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[1], 'to' => $useCases[1], 'type' => 'Association'];

            } elseif ($difficulty == 3) {
                // Nível 3: Extends
                $desc .= "O caso <strong>'{$useCases[0]}'</strong> (iniciado por <strong>'{$actors[0]}'</strong>) pode ser estendido opcionalmente por <strong>'{$useCases[3]}'</strong> (Extend). ";
                $desc .= "O ator <strong>'{$actors[2]}'</strong> também participa de <strong>'{$useCases[0]}'</strong>.";

                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[0]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[3]]; 

                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[0], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[3], 'outer' => $systemName];

                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[0], 'to' => $useCases[0], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[2], 'to' => $useCases[0], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $useCases[3], 'to' => $useCases[0], 'type' => 'Extend'];

            } elseif ($difficulty == 4) {
                // Nível 4: Generalização + Include
                $desc .= "O ator <strong>'{$actors[3]}'</strong> é um tipo especializado de <strong>'{$actors[0]}'</strong> (Generalização). ";
                $desc .= "Apenas <strong>'{$actors[0]}'</strong> se liga a <strong>'{$useCases[0]}'</strong>. ";
                $desc .= "Além disso, <strong>'{$useCases[0]}'</strong> inclui <strong>'{$useCases[4]}'</strong>.";

                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[0]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[4]];

                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[0], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[4], 'outer' => $systemName];

                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[3], 'to' => $actors[0], 'type' => 'Generalization'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[0], 'to' => $useCases[0], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $useCases[0], 'to' => $useCases[4], 'type' => 'Include'];

            } else {
                // Nível 5: Expert
                // Usa índices 1, 2 e 5 (sexto elemento)
                // Garanti que o array de useCases tenha pelo menos 6 elementos (índice 0 a 5)
                $desc .= "Desafio Mestre! <strong>'{$actors[4]}'</strong> herda de <strong>'{$actors[1]}'</strong>. ";
                $desc .= "<strong>'{$actors[1]}'</strong> inicia <strong>'{$useCases[1]}'</strong>. ";
                $desc .= "<strong>'{$useCases[1]}'</strong> inclui <strong>'{$useCases[2]}'</strong> e é estendido por <strong>'{$useCases[5]}'</strong>. ";
                $desc .= "Modele todo esse cenário complexo.";

                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[1]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[2]];
                $levelData['validation_rules']['required_nodes'][] = ['name' => $useCases[5]];

                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[1], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[2], 'outer' => $systemName];
                $levelData['validation_rules']['required_groups'][] = ['inner' => $useCases[5], 'outer' => $systemName];

                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[4], 'to' => $actors[1], 'type' => 'Generalization'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $actors[1], 'to' => $useCases[1], 'type' => 'Association'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $useCases[1], 'to' => $useCases[2], 'type' => 'Include'];
                $levelData['validation_rules']['required_connections'][] = ['from' => $useCases[5], 'to' => $useCases[1], 'type' => 'Extend'];
            }

            $levelData['description'] = $desc;
            $levels[] = $levelData;
        }

        foreach ($levels as $index => $data) {
            Level::create(array_merge($data, ['order' => $index + 1]));
        }
    }
}