<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opcoes extends Model
{
    protected $fillable = [
        'questao_id',
        'texto_opcao',
        'correta'
    ];
     public function questao()
    {
        return $this->belongsTo(Questao::class);
    }
}
