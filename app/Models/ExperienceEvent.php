<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_type',
        'source_id',
        'amount',
        'description',
        'level_after',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
