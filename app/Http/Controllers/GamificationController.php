<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Services\GamificationService;
use Illuminate\Http\Request;

class GamificationController extends Controller
{
    public function completeLesson(Request $request, Lesson $lesson, GamificationService $gamification)
    {
        $result = $gamification->grantLessonCompletion($request->user(), $lesson);

        $message = $result['awarded'] > 0
            ? "+{$result['awarded']} XP pela aula"
            : 'Você já concluiu esta aula.';

        return back()->with('status', $message);
    }

    public function completeActivity(Request $request, GamificationService $gamification)
    {
        $data = $request->validate([
            'activity_key' => 'required|string|max:100',
            'xp' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $result = $gamification->grantActivity(
            $request->user(),
            $data['activity_key'],
            $data['xp'] ?? null,
            $data['description'] ?? null
        );

        $message = $result['awarded'] > 0
            ? "+{$result['awarded']} XP registrado"
            : 'Esta atividade já foi registrada para XP.';

        return back()->with('status', $message);
    }
}
