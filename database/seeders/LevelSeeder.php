<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        // Desabilita verificação de chave estrangeira para truncar sem erro no SQLite/MySQL
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // MySQL
        } catch (\Exception $e) {
            // Se falhar (provavelmente SQLite), tenta o comando do SQLite
            try {
                DB::statement('PRAGMA foreign_keys = OFF;');
            } catch (\Exception $e2) {
                // Ignora se não conseguir
            }
        }

        Level::truncate();

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // MySQL
        } catch (\Exception $e) {
            try {
                DB::statement('PRAGMA foreign_keys = ON;'); // SQLite
            } catch (\Exception $e2) {}
        }

        $levels = [
            // --- INICIANTE (1-10) ---
            [
                'title' => 'Nível 1: A Padaria',
                'description' => "Vamos começar! Crie um sistema <strong>'Padaria'</strong>. Adicione um Ator <strong>'Cliente'</strong> e um Caso de Uso <strong>'Comprar Pão'</strong> dentro do sistema. Conecte o Cliente ao Caso de Uso.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente', 'type' => 'actor'], ['name' => 'padaria', 'type' => 'system'], ['name' => 'comprar pão', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'comprar pão', 'outer' => 'padaria']],
                    'required_connections' => [['from' => 'cliente', 'to' => 'comprar pão', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 2: Caixa Eletrônico Simples',
                'description' => "Crie um sistema <strong>'ATM'</strong>. O Ator <strong>'Usuário'</strong> deve se conectar ao Caso de Uso <strong>'Sacar Dinheiro'</strong> dentro do sistema.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário', 'type' => 'actor'], ['name' => 'atm', 'type' => 'system'], ['name' => 'sacar dinheiro', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'sacar dinheiro', 'outer' => 'atm']],
                    'required_connections' => [['from' => 'usuário', 'to' => 'sacar dinheiro', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 3: Login Básico',
                'description' => "Modele um sistema de autenticação. Sistema <strong>'Site'</strong>, Ator <strong>'Visitante'</strong> e Caso de Uso <strong>'Fazer Login'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'visitante', 'type' => 'actor'], ['name' => 'site', 'type' => 'system'], ['name' => 'fazer login', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'fazer login', 'outer' => 'site']],
                    'required_connections' => [['from' => 'visitante', 'to' => 'fazer login', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 4: Biblioteca',
                'description' => "Sistema <strong>'Biblioteca'</strong>. O <strong>'Estudante'</strong> (Ator) precisa <strong>'Consultar Livro'</strong> (Caso de Uso).",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'estudante', 'type' => 'actor'], ['name' => 'biblioteca', 'type' => 'system'], ['name' => 'consultar livro', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'consultar livro', 'outer' => 'biblioteca']],
                    'required_connections' => [['from' => 'estudante', 'to' => 'consultar livro', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 5: Dois Atores',
                'description' => "No sistema <strong>'Restaurante'</strong>, o <strong>'Cliente'</strong> faz o <strong>'Pedido'</strong> e o <strong>'Garçom'</strong> recebe o pedido. Conecte ambos ao caso de uso.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente', 'type' => 'actor'], ['name' => 'garçom', 'type' => 'actor'], ['name' => 'restaurante', 'type' => 'system'], ['name' => 'pedido', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'pedido', 'outer' => 'restaurante']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'pedido', 'type' => 'Association'],
                        ['from' => 'garçom', 'to' => 'pedido', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 6: Escola',
                'description' => "Sistema <strong>'Escola'</strong>. O <strong>'Professor'</strong> deve <strong>'Lançar Notas'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'professor', 'type' => 'actor'], ['name' => 'escola', 'type' => 'system'], ['name' => 'lançar notas', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'lançar notas', 'outer' => 'escola']],
                    'required_connections' => [['from' => 'professor', 'to' => 'lançar notas', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 7: Rede Social',
                'description' => "Sistema <strong>'App Social'</strong>. O <strong>'Usuário'</strong> pode <strong>'Postar Foto'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário', 'type' => 'actor'], ['name' => 'app social', 'type' => 'system'], ['name' => 'postar foto', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'postar foto', 'outer' => 'app social']],
                    'required_connections' => [['from' => 'usuário', 'to' => 'postar foto', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 8: E-mail',
                'description' => "Sistema <strong>'Webmail'</strong>. O <strong>'Remetente'</strong> deve <strong>'Enviar Email'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'remetente', 'type' => 'actor'], ['name' => 'webmail', 'type' => 'system'], ['name' => 'enviar email', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'enviar email', 'outer' => 'webmail']],
                    'required_connections' => [['from' => 'remetente', 'to' => 'enviar email', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 9: Elevador',
                'description' => "Sistema <strong>'Prédio'</strong>. O <strong>'Passageiro'</strong> deve <strong>'Chamar Elevador'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'passageiro', 'type' => 'actor'], ['name' => 'prédio', 'type' => 'system'], ['name' => 'chamar elevador', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'chamar elevador', 'outer' => 'prédio']],
                    'required_connections' => [['from' => 'passageiro', 'to' => 'chamar elevador', 'type' => 'Association']]
                ]
            ],
            [
                'title' => 'Nível 10: Streaming',
                'description' => "Sistema <strong>'Netflix'</strong>. O <strong>'Assinante'</strong> deve <strong>'Assistir Filme'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'assinante', 'type' => 'actor'], ['name' => 'netflix', 'type' => 'system'], ['name' => 'assistir filme', 'type' => 'usecase']],
                    'required_groups' => [['inner' => 'assistir filme', 'outer' => 'netflix']],
                    'required_connections' => [['from' => 'assinante', 'to' => 'assistir filme', 'type' => 'Association']]
                ]
            ],

            // --- INTERMÉDIO (11-25) - INCLUDES E EXTENDS ---
            [
                'title' => 'Nível 11: Compra com Verificação',
                'description' => "No sistema <strong>'Loja'</strong>, o caso <strong>'Comprar Item'</strong> deve incluir obrigatoriamente <strong>'Verificar Estoque'</strong> (Use &laquo;include&raquo;). Conecte o <strong>'Cliente'</strong> a comprar.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'loja'], ['name' => 'comprar item'], ['name' => 'verificar estoque']],
                    'required_groups' => [['inner' => 'comprar item', 'outer' => 'loja'], ['inner' => 'verificar estoque', 'outer' => 'loja']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'comprar item', 'type' => 'Association'],
                        ['from' => 'comprar item', 'to' => 'verificar estoque', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 12: Login Seguro',
                'description' => "Sistema <strong>'Portal'</strong>. <strong>'Fazer Login'</strong> inclui <strong>'Validar Senha'</strong>. Ator: <strong>'Usuário'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário'], ['name' => 'portal'], ['name' => 'fazer login'], ['name' => 'validar senha']],
                    'required_groups' => [['inner' => 'fazer login', 'outer' => 'portal'], ['inner' => 'validar senha', 'outer' => 'portal']],
                    'required_connections' => [
                        ['from' => 'usuário', 'to' => 'fazer login', 'type' => 'Association'],
                        ['from' => 'fazer login', 'to' => 'validar senha', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 13: Saque no Banco',
                'description' => "Sistema <strong>'Banco'</strong>. <strong>'Sacar'</strong> pode ser estendido por <strong>'Imprimir Recibo'</strong> (Use &laquo;extend&raquo;). A seta vai do estendido para o base! Ator: <strong>'Cliente'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'banco'], ['name' => 'sacar'], ['name' => 'imprimir recibo']],
                    'required_groups' => [['inner' => 'sacar', 'outer' => 'banco'], ['inner' => 'imprimir recibo', 'outer' => 'banco']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'sacar', 'type' => 'Association'],
                        ['from' => 'imprimir recibo', 'to' => 'sacar', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 14: Pedido de Pizza',
                'description' => "Sistema <strong>'Pizzaria'</strong>. <strong>'Pedir Pizza'</strong> pode ser estendido por <strong>'Adicionar Borda'</strong>. Ator: <strong>'Cliente'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'pizzaria'], ['name' => 'pedir pizza'], ['name' => 'adicionar borda']],
                    'required_groups' => [['inner' => 'pedir pizza', 'outer' => 'pizzaria'], ['inner' => 'adicionar borda', 'outer' => 'pizzaria']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'pedir pizza', 'type' => 'Association'],
                        ['from' => 'adicionar borda', 'to' => 'pedir pizza', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 15: Postagem em Blog',
                'description' => "Sistema <strong>'Blog'</strong>. <strong>'Escrever Post'</strong> inclui <strong>'Salvar Rascunho'</strong>. Ator: <strong>'Autor'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'autor'], ['name' => 'blog'], ['name' => 'escrever post'], ['name' => 'salvar rascunho']],
                    'required_groups' => [['inner' => 'escrever post', 'outer' => 'blog'], ['inner' => 'salvar rascunho', 'outer' => 'blog']],
                    'required_connections' => [
                        ['from' => 'autor', 'to' => 'escrever post', 'type' => 'Association'],
                        ['from' => 'escrever post', 'to' => 'salvar rascunho', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 16: Matrícula',
                'description' => "Sistema <strong>'Faculdade'</strong>. <strong>'Realizar Matrícula'</strong> inclui <strong>'Verificar Vagas'</strong>. Ator: <strong>'Aluno'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'aluno'], ['name' => 'faculdade'], ['name' => 'realizar matrícula'], ['name' => 'verificar vagas']],
                    'required_groups' => [['inner' => 'realizar matrícula', 'outer' => 'faculdade'], ['inner' => 'verificar vagas', 'outer' => 'faculdade']],
                    'required_connections' => [
                        ['from' => 'aluno', 'to' => 'realizar matrícula', 'type' => 'Association'],
                        ['from' => 'realizar matrícula', 'to' => 'verificar vagas', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 17: Exame Médico',
                'description' => "Sistema <strong>'Clínica'</strong>. <strong>'Realizar Exame'</strong> estendido por <strong>'Pedir Biópsia'</strong> (opcional). Ator: <strong>'Médico'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'médico'], ['name' => 'clínica'], ['name' => 'realizar exame'], ['name' => 'pedir biópsia']],
                    'required_groups' => [['inner' => 'realizar exame', 'outer' => 'clínica'], ['inner' => 'pedir biópsia', 'outer' => 'clínica']],
                    'required_connections' => [
                        ['from' => 'médico', 'to' => 'realizar exame', 'type' => 'Association'],
                        ['from' => 'pedir biópsia', 'to' => 'realizar exame', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 18: Reserva de Voo',
                'description' => "Sistema <strong>'Companhia Aérea'</strong>. <strong>'Reservar Voo'</strong> inclui <strong>'Selecionar Assento'</strong>. Ator: <strong>'Passageiro'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'passageiro'], ['name' => 'companhia'], ['name' => 'reservar voo'], ['name' => 'selecionar assento']],
                    'required_groups' => [['inner' => 'reservar voo', 'outer' => 'companhia'], ['inner' => 'selecionar assento', 'outer' => 'companhia']],
                    'required_connections' => [
                        ['from' => 'passageiro', 'to' => 'reservar voo', 'type' => 'Association'],
                        ['from' => 'reservar voo', 'to' => 'selecionar assento', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 19: Arquivo',
                'description' => "Sistema <strong>'OS'</strong>. <strong>'Salvar Arquivo'</strong> estendido por <strong>'Salvar Como'</strong>. Ator: <strong>'Usuário'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário'], ['name' => 'os'], ['name' => 'salvar arquivo'], ['name' => 'salvar como']],
                    'required_groups' => [['inner' => 'salvar arquivo', 'outer' => 'os'], ['inner' => 'salvar como', 'outer' => 'os']],
                    'required_connections' => [
                        ['from' => 'usuário', 'to' => 'salvar arquivo', 'type' => 'Association'],
                        ['from' => 'salvar como', 'to' => 'salvar arquivo', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 20: Pagamento',
                'description' => "Sistema <strong>'E-commerce'</strong>. <strong>'Pagar'</strong> inclui <strong>'Processar Cartão'</strong>. Ator: <strong>'Cliente'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'e-commerce'], ['name' => 'pagar'], ['name' => 'processar cartão']],
                    'required_groups' => [['inner' => 'pagar', 'outer' => 'e-commerce'], ['inner' => 'processar cartão', 'outer' => 'e-commerce']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'pagar', 'type' => 'Association'],
                        ['from' => 'pagar', 'to' => 'processar cartão', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 21: Atualizar Cadastro',
                'description' => "Sistema <strong>'Portal RH'</strong>. <strong>'Atualizar Dados'</strong> inclui <strong>'Verificar CPF'</strong>. Ator: <strong>'Funcionário'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'funcionário'], ['name' => 'portal rh'], ['name' => 'atualizar dados'], ['name' => 'verificar cpf']],
                    'required_groups' => [['inner' => 'atualizar dados', 'outer' => 'portal rh'], ['inner' => 'verificar cpf', 'outer' => 'portal rh']],
                    'required_connections' => [
                        ['from' => 'funcionário', 'to' => 'atualizar dados', 'type' => 'Association'],
                        ['from' => 'atualizar dados', 'to' => 'verificar cpf', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 22: Enviar Mensagem',
                'description' => "Sistema <strong>'Chat'</strong>. <strong>'Enviar Mensagem'</strong> estendido por <strong>'Anexar Arquivo'</strong>. Ator: <strong>'Usuário'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário'], ['name' => 'chat'], ['name' => 'enviar mensagem'], ['name' => 'anexar arquivo']],
                    'required_groups' => [['inner' => 'enviar mensagem', 'outer' => 'chat'], ['inner' => 'anexar arquivo', 'outer' => 'chat']],
                    'required_connections' => [
                        ['from' => 'usuário', 'to' => 'enviar mensagem', 'type' => 'Association'],
                        ['from' => 'anexar arquivo', 'to' => 'enviar mensagem', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 23: Devolução',
                'description' => "Sistema <strong>'Loja'</strong>. <strong>'Devolver Produto'</strong> inclui <strong>'Checar Nota Fiscal'</strong>. Ator: <strong>'Cliente'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'loja'], ['name' => 'devolver produto'], ['name' => 'checar nota']],
                    'required_groups' => [['inner' => 'devolver produto', 'outer' => 'loja'], ['inner' => 'checar nota', 'outer' => 'loja']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'devolver produto', 'type' => 'Association'],
                        ['from' => 'devolver produto', 'to' => 'checar nota', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 24: Reserva de Hotel',
                'description' => "Sistema <strong>'Hotel'</strong>. <strong>'Reservar Quarto'</strong> estendido por <strong>'Pedir Café da Manhã'</strong>. Ator: <strong>'Hóspede'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'hóspede'], ['name' => 'hotel'], ['name' => 'reservar quarto'], ['name' => 'pedir café']],
                    'required_groups' => [['inner' => 'reservar quarto', 'outer' => 'hotel'], ['inner' => 'pedir café', 'outer' => 'hotel']],
                    'required_connections' => [
                        ['from' => 'hóspede', 'to' => 'reservar quarto', 'type' => 'Association'],
                        ['from' => 'pedir café', 'to' => 'reservar quarto', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 25: Login Complexo',
                'description' => "Sistema <strong>'Segurança'</strong>. <strong>'Login'</strong> inclui <strong>'Validar Senha'</strong> E é estendido por <strong>'Mostrar Erro de Senha'</strong>. Ator: <strong>'User'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'user'], ['name' => 'segurança'], ['name' => 'login'], ['name' => 'validar senha'], ['name' => 'mostrar erro']],
                    'required_groups' => [['inner' => 'login', 'outer' => 'segurança'], ['inner' => 'validar senha', 'outer' => 'segurança'], ['inner' => 'mostrar erro', 'outer' => 'segurança']],
                    'required_connections' => [
                        ['from' => 'user', 'to' => 'login', 'type' => 'Association'],
                        ['from' => 'login', 'to' => 'validar senha', 'type' => 'Include'],
                        ['from' => 'mostrar erro', 'to' => 'login', 'type' => 'Extend']
                    ]
                ]
            ],

            // --- AVANÇADO (26-40) - GENERALIZAÇÃO E MÚLTIPLOS ATORES ---
            [
                'title' => 'Nível 26: Herança de Atores',
                'description' => "Crie um sistema <strong>'Admin'</strong>. Tenha um Ator <strong>'Usuário'</strong> e um Ator <strong>'Administrador'</strong>. O Administrador deve herdar (Generalização) de Usuário. Ambos usam o caso <strong>'Logar'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'usuário'], ['name' => 'administrador'], ['name' => 'logar']],
                    'required_connections' => [
                        ['from' => 'administrador', 'to' => 'usuário', 'type' => 'Generalization'],
                        ['from' => 'usuário', 'to' => 'logar', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 27: Tipos de Pagamento',
                'description' => "Sistema <strong>'Pagamento'</strong>. Caso de uso <strong>'Pagar'</strong>. Casos <strong>'Pagar com Boleto'</strong> e <strong>'Pagar com Cartão'</strong> herdam de 'Pagar'.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'pagar'], ['name' => 'pagar com boleto'], ['name' => 'pagar com cartão']],
                    'required_connections' => [
                        ['from' => 'pagar com boleto', 'to' => 'pagar', 'type' => 'Generalization'],
                        ['from' => 'pagar com cartão', 'to' => 'pagar', 'type' => 'Generalization']
                    ]
                ]
            ],
            [
                'title' => 'Nível 28: Funcionários',
                'description' => "Ator <strong>'Funcionário'</strong>. Atores <strong>'Gerente'</strong> e <strong>'Caixa'</strong> herdam de Funcionário. Sistema <strong>'Empresa'</strong> com caso <strong>'Bater Ponto'</strong> ligado ao Funcionário.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'funcionário'], ['name' => 'gerente'], ['name' => 'caixa'], ['name' => 'bater ponto']],
                    'required_connections' => [
                        ['from' => 'gerente', 'to' => 'funcionário', 'type' => 'Generalization'],
                        ['from' => 'caixa', 'to' => 'funcionário', 'type' => 'Generalization'],
                        ['from' => 'funcionário', 'to' => 'bater ponto', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 29: Pesquisa',
                'description' => "Sistema <strong>'Busca'</strong>. Caso <strong>'Pesquisar'</strong>. Caso <strong>'Pesquisa Avançada'</strong> herda de Pesquisar. Ator <strong>'Internauta'</strong> liga a Pesquisar.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'internauta'], ['name' => 'pesquisar'], ['name' => 'pesquisa avançada']],
                    'required_connections' => [
                        ['from' => 'pesquisa avançada', 'to' => 'pesquisar', 'type' => 'Generalization'],
                        ['from' => 'internauta', 'to' => 'pesquisar', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 30: Validar Usuário',
                'description' => "Sistema <strong>'Acesso'</strong>. Caso <strong>'Validar Usuário'</strong>. Caso <strong>'Validar pela Retina'</strong> herda de Validar Usuário. Ator <strong>'Segurança'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'segurança'], ['name' => 'validar usuário'], ['name' => 'validar pela retina']],
                    'required_connections' => [
                        ['from' => 'validar pela retina', 'to' => 'validar usuário', 'type' => 'Generalization'],
                        ['from' => 'segurança', 'to' => 'validar usuário', 'type' => 'Association']
                    ]
                ]
            ],
             // --- EXPERT (41-50) - MISTURA TOTAL ---
             [
                'title' => 'Nível 41: E-commerce Completo',
                'description' => "Sistema <strong>'Loja'</strong>. Ator <strong>'Cliente'</strong> liga a <strong>'Fazer Pedido'</strong>. 'Fazer Pedido' inclui <strong>'Pagamento'</strong>. 'Pagamento' é generalizado por <strong>'Cartão'</strong> e <strong>'Pix'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'fazer pedido'], ['name' => 'pagamento'], ['name' => 'cartão'], ['name' => 'pix']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'fazer pedido', 'type' => 'Association'],
                        ['from' => 'fazer pedido', 'to' => 'pagamento', 'type' => 'Include'],
                        ['from' => 'cartão', 'to' => 'pagamento', 'type' => 'Generalization'],
                        ['from' => 'pix', 'to' => 'pagamento', 'type' => 'Generalization']
                    ]
                ]
            ],
            [
                'title' => 'Nível 42: Gestão de Biblioteca',
                'description' => "Sistema <strong>'Lib'</strong>. Ator <strong>'Bibliotecário'</strong> liga a <strong>'Cadastrar Livro'</strong>. 'Cadastrar Livro' estendido por <strong>'Importar CSV'</strong>. Ator <strong>'Visitante'</strong> liga a <strong>'Buscar'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'bibliotecário'], ['name' => 'cadastrar livro'], ['name' => 'importar csv'], ['name' => 'visitante'], ['name' => 'buscar']],
                    'required_connections' => [
                        ['from' => 'bibliotecário', 'to' => 'cadastrar livro', 'type' => 'Association'],
                        ['from' => 'importar csv', 'to' => 'cadastrar livro', 'type' => 'Extend'],
                        ['from' => 'visitante', 'to' => 'buscar', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 43: Sistema Bancário',
                'description' => "Sistema <strong>'Bank'</strong>. Ator <strong>'Cliente'</strong> e <strong>'Gerente'</strong> (Gerente herda de Cliente). Ambos ligam a <strong>'Login'</strong>. 'Login' inclui <strong>'Auth'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'gerente'], ['name' => 'login'], ['name' => 'auth']],
                    'required_connections' => [
                        ['from' => 'gerente', 'to' => 'cliente', 'type' => 'Generalization'],
                        ['from' => 'cliente', 'to' => 'login', 'type' => 'Association'],
                        ['from' => 'login', 'to' => 'auth', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 44: Venda de Ingressos',
                'description' => "Sistema <strong>'Cinema'</strong>. Ator <strong>'Cliente'</strong> liga a <strong>'Comprar'</strong>. 'Comprar' estendido por <strong>'Usar Cupom'</strong>. 'Comprar' inclui <strong>'Selecionar Assento'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'cliente'], ['name' => 'comprar'], ['name' => 'usar cupom'], ['name' => 'selecionar assento']],
                    'required_connections' => [
                        ['from' => 'cliente', 'to' => 'comprar', 'type' => 'Association'],
                        ['from' => 'usar cupom', 'to' => 'comprar', 'type' => 'Extend'],
                        ['from' => 'comprar', 'to' => 'selecionar assento', 'type' => 'Include']
                    ]
                ]
            ],
             [
                'title' => 'Nível 45: Rede Hospitalar',
                'description' => "Sistema <strong>'Hospital'</strong>. Ator <strong>'Médico'</strong> liga a <strong>'Prescrever'</strong>. Ator <strong>'Enfermeiro'</strong> liga a <strong>'Ministrar'</strong>. 'Ministrar' inclui <strong>'Ler Prontuário'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'médico'], ['name' => 'prescrever'], ['name' => 'enfermeiro'], ['name' => 'ministrar'], ['name' => 'ler prontuário']],
                    'required_connections' => [
                        ['from' => 'médico', 'to' => 'prescrever', 'type' => 'Association'],
                        ['from' => 'enfermeiro', 'to' => 'ministrar', 'type' => 'Association'],
                        ['from' => 'ministrar', 'to' => 'ler prontuário', 'type' => 'Include']
                    ]
                ]
            ],
             [
                'title' => 'Nível 46: EAD',
                'description' => "Sistema <strong>'LMS'</strong>. Ator <strong>'Aluno'</strong> liga a <strong>'Assistir Aula'</strong>. 'Assistir Aula' estendido por <strong>'Baixar PDF'</strong>. 'Assistir Aula' inclui <strong>'Marcar Presença'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'aluno'], ['name' => 'assistir aula'], ['name' => 'baixar pdf'], ['name' => 'marcar presença']],
                    'required_connections' => [
                        ['from' => 'aluno', 'to' => 'assistir aula', 'type' => 'Association'],
                        ['from' => 'baixar pdf', 'to' => 'assistir aula', 'type' => 'Extend'],
                        ['from' => 'assistir aula', 'to' => 'marcar presença', 'type' => 'Include']
                    ]
                ]
            ],
            [
                'title' => 'Nível 47: Uber',
                'description' => "Sistema <strong>'Ride'</strong>. Ator <strong>'Passageiro'</strong> liga a <strong>'Pedir Carro'</strong>. 'Pedir Carro' inclui <strong>'Definir Destino'</strong>. 'Definir Destino' estendido por <strong>'Adicionar Parada'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'passageiro'], ['name' => 'pedir carro'], ['name' => 'definir destino'], ['name' => 'adicionar parada']],
                    'required_connections' => [
                        ['from' => 'passageiro', 'to' => 'pedir carro', 'type' => 'Association'],
                        ['from' => 'pedir carro', 'to' => 'definir destino', 'type' => 'Include'],
                        ['from' => 'adicionar parada', 'to' => 'definir destino', 'type' => 'Extend']
                    ]
                ]
            ],
            [
                'title' => 'Nível 48: Fórum',
                'description' => "Sistema <strong>'Forum'</strong>. Ator <strong>'Membro'</strong> liga a <strong>'Postar'</strong>. Ator <strong>'Moderador'</strong> herda de Membro e liga a <strong>'Banir'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'membro'], ['name' => 'postar'], ['name' => 'moderador'], ['name' => 'banir']],
                    'required_connections' => [
                        ['from' => 'membro', 'to' => 'postar', 'type' => 'Association'],
                        ['from' => 'moderador', 'to' => 'membro', 'type' => 'Generalization'],
                        ['from' => 'moderador', 'to' => 'banir', 'type' => 'Association']
                    ]
                ]
            ],
            [
                'title' => 'Nível 49: Controle de Acesso',
                'description' => "Sistema <strong>'Portaria'</strong>. Ator <strong>'Visitante'</strong> liga a <strong>'Entrar'</strong>. 'Entrar' inclui <strong>'Identificar'</strong>. 'Identificar' generalizado por <strong>'Biometria'</strong> e <strong>'Cartão'</strong>.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'visitante'], ['name' => 'entrar'], ['name' => 'identificar'], ['name' => 'biometria'], ['name' => 'cartão']],
                    'required_connections' => [
                        ['from' => 'visitante', 'to' => 'entrar', 'type' => 'Association'],
                        ['from' => 'entrar', 'to' => 'identificar', 'type' => 'Include'],
                        ['from' => 'biometria', 'to' => 'identificar', 'type' => 'Generalization'],
                        ['from' => 'cartão', 'to' => 'identificar', 'type' => 'Generalization']
                    ]
                ]
            ],
            [
                'title' => 'Nível 50: O Desafio Final',
                'description' => "Sistema <strong>'Mundo'</strong>. Ator <strong>'Pessoa'</strong> liga a <strong>'Viver'</strong>. 'Viver' inclui <strong>'Respirar'</strong>. 'Viver' estendido por <strong>'Sonhar'</strong>. Ator <strong>'Sonhador'</strong> herda de Pessoa.",
                'validation_rules' => [
                    'required_nodes' => [['name' => 'pessoa'], ['name' => 'mundo'], ['name' => 'viver'], ['name' => 'respirar'], ['name' => 'sonhar'], ['name' => 'sonhador']],
                    'required_connections' => [
                        ['from' => 'pessoa', 'to' => 'viver', 'type' => 'Association'],
                        ['from' => 'viver', 'to' => 'respirar', 'type' => 'Include'],
                        ['from' => 'sonhar', 'to' => 'viver', 'type' => 'Extend'],
                        ['from' => 'sonhador', 'to' => 'pessoa', 'type' => 'Generalization']
                    ]
                ]
            ]
        ];

        foreach ($levels as $index => $data) {
            Level::create(array_merge($data, ['order' => $index + 1]));
        }
    }
}