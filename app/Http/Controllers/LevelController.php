<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    /**
     * Lista todos os níveis e mostra o status (concluído ou pendente).
     */
    public function index()
    {
        // Busca todos os níveis ordenados
        $levels = Level::orderBy('order')->get();
        
        // Pega apenas os IDs dos níveis que o usuário logado já fez
        $completedLevelIds = Auth::user()
            ->completedLevels()
            ->pluck('levels.id')
            ->toArray();

        return view('levels.index', compact('levels', 'completedLevelIds'));
    }

    /**
     * Mostra os detalhes de um nível para o usuário realizar a tarefa.
     */
    public function show(Level $level)
    {
        return view('levels.show', compact('level'));
    }

    /**
     * Salva que o usuário completou o nível.
     */
    public function complete(Request $request, Level $level)
    {
        $user = Auth::user();

        // Verifica se já existe registro na pivot table para não duplicar
        if (!$user->completedLevels()->where('level_id', $level->id)->exists()) {
            
            $user->completedLevels()->attach($level->id, [
                'completed_at' => now(),
                'score' => $request->input('score', 100) // Pontuação padrão 100
            ]);
            
            return redirect()->route('levels.index')
                ->with('success', 'Parabéns! Nível concluído com sucesso.');
        }

        return redirect()->route('levels.index')
            ->with('info', 'Você já completou este nível anteriormente.');
    }
}