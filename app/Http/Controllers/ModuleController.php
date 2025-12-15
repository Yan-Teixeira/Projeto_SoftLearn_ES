<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula_modulos;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index() 
    {
        $userId = Auth::id();

        $modules = Aula_modulos::withCount('lessons')->get();

        $completedByModule = LessonCompletion::where('user_id', $userId)
            ->join('lessons', 'lessons.id', '=', 'lesson_completions.lesson_id')
            ->selectRaw('lessons.module_id, count(*) as total')
            ->groupBy('lessons.module_id')
            ->pluck('total', 'module_id');

        $modulos = $modules->map(function ($module) use ($completedByModule) {
            return [
                'id' => $module->id,
                'titulo' => $module->titulo,
                'descricao' => $module->descricao,
                'aulas_total' => $module->lessons_count,
                'aulas_concluidas' => $completedByModule[$module->id] ?? 0,
                'imagem_url' => 'https://via.placeholder.com/300x200.png/2c7a6c/ffffff?text=Modulo+' . $module->id,
            ];
        });

        return view('aulas', [
            'modulos' => $modulos
        ]);
    }

    public function show($id) 
    {
        $modulo = Aula_modulos::with(['lessons' => function ($query) {
            $query->orderBy('ordem');
        }])->findOrFail($id);

        $syllabus = Aula_modulos::select('id', 'titulo')->get();

        $concluidas = LessonCompletion::where('user_id', Auth::id())
            ->pluck('lesson_id')
            ->toArray();

        return view('aula-modulo', [
            'modulo' => $modulo,
            'syllabus' => $syllabus,
            'concluidas' => $concluidas,
        ]);
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required_without:nome|string|max:255',
            'nome' => 'required_without:titulo|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $titulo = $request->titulo ?? $request->nome;

        Aula_modulos::create([
            'titulo' => $titulo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('modules.index')->with('success', 'Módulo criado com sucesso!');
    }

    public function destroy(Aula_modulos $module)
    {
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Módulo deletado com sucesso!');
    }
}
