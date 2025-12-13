<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula_modulos extends Model
{
    use HasFactory;
    
    // Define quais campos podem ser preenchidos em massa
    
    protected $fillable = ['titulo', 'descricao'];

    // Define o relacionamento: Um Módulo tem muitas Lições
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}