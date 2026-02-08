<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'titulo',
        'dificuldade_escolhida',
        'status',
        'slug',
        'fk_aula'
    ];
     public function aula()
    {
        return $this->belongsTo(Aulas::class);
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class);
    }
}
