<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'order', 
        'route_name',
        'validation_rules' // Permite salvar as regras
    ];

    /**
     * ESSENCIAL: Converte o array de regras do Seeder para JSON ao salvar no banco.
     * Sem isso, a inclusão falha.
     */
    protected $casts = [
        'validation_rules' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'level_user')
                    ->withPivot('completed_at', 'score')
                    ->withTimestamps();
    }
}