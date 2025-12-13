<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'titulo', 'conteudo', 'ordem'];

    // Relacionamento: Uma Lição pertence a um Módulo
    public function module()
    {
        return $this->belongsTo(Aula_modulos::class);
    }
}