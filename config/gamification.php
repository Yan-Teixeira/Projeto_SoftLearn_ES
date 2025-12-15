<?php

return [
    // XP base concedido ao concluir uma aula
    'lesson_xp' => 50,

    // XP padrão para registrar uma atividade prática
    'activity_xp' => 30,

    // Parâmetros da curva de progressão de nível
    'leveling' => [
        'base' => 120,      // XP mínimo para sair do nível 1
        'growth' => 1.25,   // Fator de crescimento por nível
    ],
];
