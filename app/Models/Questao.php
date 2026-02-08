<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    protected $table = 'questoes'; 

    protected $fillable = [
        'quiz_id',
        'enunciado',
        'dica'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function opcoes()
    {
        return $this->hasMany(Opcoes::class);
    }
}
