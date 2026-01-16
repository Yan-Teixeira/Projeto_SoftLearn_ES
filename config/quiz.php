<?php

return [

/*
|--------------------------------------------------------------------------
| 1. Introdução à Engenharia de Software
|--------------------------------------------------------------------------
*/
'introducao' => [
    'titulo' => 'Introdução à Engenharia de Software',
    'perguntas' => [
        [
            'pergunta' => 'O que compõe um Produto de Software segundo a definição clássica?',
            'alternativas' => [
                'A' => 'Apenas o código-fonte executável.',
                'B' => 'O código-fonte e o banco de dados.',
                'C' => 'Programas de computador e documentação associada.',
                'D' => 'Hardware e sistemas operacionais.'
            ],
            'correta' => 'C'
        ],
        [
            'pergunta' => 'Qual é o principal objetivo da Engenharia de Software?',
            'alternativas' => [
                'A' => 'Aumentar a velocidade de processamento do hardware.',
                'B' => 'Desenvolver sistemas sem necessidade de manutenção.',
                'C' => 'Controle de custos, prazos e níveis de qualidade no desenvolvimento.',
                'D' => 'Eliminar a necessidade de documentação técnica.'
            ],
            'correta' => 'C'
        ],
        [
            'pergunta' => 'A Crise do Software é caracterizada por:',
            'alternativas' => [
                'A' => 'Falta de computadores no mercado.',
                'B' => 'Projetos que ultrapassam prazos e orçamentos com baixa qualidade.',
                'C' => 'Excesso de programadores qualificados.',
                'D' => 'Aumento da velocidade de entrega dos sistemas.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Qual a diferença entre software genérico e customizado?',
            'alternativas' => [
                'A' => 'O genérico é grátis, o customizado é pago.',
                'B' => 'Genérico é para o mercado geral; customizado é para um cliente específico.',
                'C' => 'Genérico não tem documentação; customizado tem.',
                'D' => 'Não há diferença técnica entre eles.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Engenharia de Software se diferencia da Ciência da Computação pois:',
            'alternativas' => [
                'A' => 'Foca em teorias e fundamentos matemáticos.',
                'B' => 'Foca nos aspectos práticos da produção de software.',
                'C' => 'Não utiliza algoritmos.',
                'D' => 'É uma disciplina puramente teórica.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Qual é um dos "Acidentes" que causa a crise do software?',
            'alternativas' => [
                'A' => 'Complexidade dos sistemas.',
                'B' => 'Dificuldade de formalização.',
                'C' => 'Falta de qualificação técnica e má qualidade de métodos.',
                'D' => 'Incompatibilidade de hardware.'
            ],
            'correta' => 'C'
        ],
        [
            'pergunta' => 'Qual destes é um Artefato da Engenharia de Software?',
            'alternativas' => [
                'A' => 'Documento de Requisitos.',
                'B' => 'O monitor do computador.',
                'C' => 'O salário do desenvolvedor.',
                'D' => 'A velocidade da internet.'
            ],
            'correta' => 'A'
        ],
        [
            'pergunta' => 'A manutenção de software é considerada:',
            'alternativas' => [
                'A' => 'Uma atividade desnecessária em bons projetos.',
                'B' => 'Difícil e custosa, sendo um dos sintomas da crise do software.',
                'C' => 'Uma tarefa realizada apenas por estagiários.',
                'D' => 'Algo que ocorre antes da implementação.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Sobre a qualidade do software, é correto afirmar:',
            'alternativas' => [
                'A' => 'É subjetiva e não pode ser medida.',
                'B' => 'Depende apenas da ausência de bugs no código.',
                'C' => 'Envolve eficácia, confiabilidade e satisfação do usuário.',
                'D' => 'É garantida apenas pelo uso da linguagem Java.'
            ],
            'correta' => 'C'
        ],
        [
            'pergunta' => 'Quem são os stakeholders em um projeto de software?',
            'alternativas' => [
                'A' => 'Apenas os programadores.',
                'B' => 'Apenas os donos da empresa.',
                'C' => 'Todas as pessoas envolvidas ou afetadas pelo sistema.',
                'D' => 'Apenas os usuários finais.'
            ],
            'correta' => 'C'
        ],
    ]
],

/*
|--------------------------------------------------------------------------
| 2. Modelos de Processo
|--------------------------------------------------------------------------
*/
'processos' => [
    'titulo' => 'Modelos de Processo',
    'perguntas' => [
        [
            'pergunta' => 'O que é um Processo de Software?',
            'alternativas' => [
                'A' => 'Um programa em execução no SO.',
                'B' => 'Um conjunto de atividades para transformar requisitos em um sistema.',
                'C' => 'Uma ferramenta CASE.',
                'D' => 'O compilador da linguagem.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'No RUP, o que ocorre na fase de Elaboração?',
            'alternativas' => [
                'A' => 'Entrega do software ao usuário.',
                'B' => 'Definição da arquitetura e mitigação de riscos.',
                'C' => 'Codificação de todo o sistema.',
                'D' => 'Apenas o levantamento de custos.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Qual a característica principal do Modelo Cascata?',
            'alternativas' => [
                'A' => 'Permite voltar fases a qualquer momento.',
                'B' => 'É um modelo iterativo e incremental.',
                'C' => 'As fases são sequenciais; uma começa quando a anterior termina.',
                'D' => 'Não exige documentação.'
            ],
            'correta' => 'C'
        ],
        [
            'pergunta' => 'O Modelo Espiral foca principalmente em:',
            'alternativas' => [
                'A' => 'Velocidade de codificação.',
                'B' => 'Análise de riscos em cada ciclo.',
                'C' => 'Redução do número de desenvolvedores.',
                'D' => 'Desenvolvimento web apenas.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'No RUP, a fase de Transição foca em:',
            'alternativas' => [
                'A' => 'Criar novos requisitos.',
                'B' => 'Beta tests, treinamento de usuários e correções finais.',
                'C' => 'Desenvolver o modelo de dados.',
                'D' => 'Escolher a linguagem de programação.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'O que é Abstração no contexto de modelos?',
            'alternativas' => [
                'A' => 'Ignorar o cliente.',
                'B' => 'Suprimir detalhes irrelevantes para focar no que é importante.',
                'C' => 'Codificar sem pensar no design.',
                'D' => 'Criar sistemas sem interface gráfica.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Modelos iterativos e incrementais visam:',
            'alternativas' => [
                'A' => 'Entregar o sistema todo no final.',
                'B' => 'Desenvolver partes do sistema em ciclos repetidos.',
                'C' => 'Eliminar a fase de testes.',
                'D' => 'Trabalhar apenas com requisitos fixos.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'A fase de Construção do RUP tem como foco:',
            'alternativas' => [
                'A' => 'Definir o negócio.',
                'B' => 'Implementar e testar funcionalidades.',
                'C' => 'Instalar o servidor físico.',
                'D' => 'Finalizar contrato jurídico.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'Modelagem de Negócio no RUP serve para:',
            'alternativas' => [
                'A' => 'Calcular o lucro.',
                'B' => 'Entender processos da organização cliente.',
                'C' => 'Vender o software.',
                'D' => 'Substituir análise de requisitos.'
            ],
            'correta' => 'B'
        ],
        [
            'pergunta' => 'A fase de Concepção (Inception) busca:',
            'alternativas' => [
                'A' => 'Terminar o manual.',
                'B' => 'Estabelecer escopo e viabilidade.',
                'C' => 'Codificar segurança.',
                'D' => 'Testes de estresse.'
            ],
            'correta' => 'B'
        ],
    ]
],

];
