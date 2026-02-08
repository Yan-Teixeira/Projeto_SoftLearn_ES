<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $fillable = ['modulo_id', 'titulo', 'conteudo', 'status'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
