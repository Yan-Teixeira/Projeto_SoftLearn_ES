<?php

namespace App\Services;

use App\Models\ExperienceEvent;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GamificationService
{
    public function grantLessonCompletion(User $user, Lesson $lesson): array
    {
        $completion = LessonCompletion::firstOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            ['completed_at' => now()]
        );

        if (! $completion->wasRecentlyCreated) {
            return [
                'awarded' => 0,
                'level_up' => false,
                'already_completed' => true,
            ];
        }

        return $this->addExperience(
            $user,
            (int) config('gamification.lesson_xp', 50),
            'lesson',
            (string) $lesson->id,
            'Concluiu a aula: ' . $lesson->titulo
        );
    }

    public function grantActivity(User $user, string $activityKey, ?int $xp = null, ?string $description = null): array
    {
        return $this->addExperience(
            $user,
            $xp ?? (int) config('gamification.activity_xp', 30),
            'activity',
            $activityKey,
            $description ?? 'Atividade concluída'
        );
    }

    public function addExperience(User $user, int $amount, string $sourceType, string $sourceId = '', ?string $description = null): array
    {
        return DB::transaction(function () use ($user, $amount, $sourceType, $sourceId, $description) {
            $sourceKey = $sourceId === null ? '' : $sourceId;
            $alreadyLogged = ExperienceEvent::where('user_id', $user->id)
                ->where('source_type', $sourceType)
                ->where('source_id', $sourceKey)
                ->exists();

            if ($alreadyLogged) {
                return [
                    'awarded' => 0,
                    'level_up' => false,
                    'already_logged' => true,
                ];
            }

            $newXp = $user->xp + $amount;
            $newLevel = $this->calculateLevel($newXp);
            $levelUp = $newLevel > $user->level;

            $user->xp = $newXp;
            $user->level = $newLevel;
            $user->save();

            ExperienceEvent::create([
                'user_id' => $user->id,
                'source_type' => $sourceType,
                'source_id' => $sourceKey,
                'amount' => $amount,
                'description' => $description,
                'level_after' => $newLevel,
            ]);

            return [
                'awarded' => $amount,
                'level_up' => $levelUp,
                'level' => $newLevel,
                'xp' => $newXp,
            ];
        });
    }

    public function calculateLevel(int $xp): int
    {
        $base = (int) config('gamification.leveling.base', 120);
        $growth = (float) config('gamification.leveling.growth', 1.25);

        $level = 1;
        $required = $base;
        $pool = $xp;

        while ($pool >= $required) {
            $pool -= $required;
            $level++;
            $required = (int) round($required * $growth);
        }

        return $level;
    }
}
