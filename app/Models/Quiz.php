<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // TA LINIJKA JEST KONIECZNA DO DODAWANIA!
    protected $fillable = ['title', 'description'];

    // Relacja z pytaniami (przyda się później)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}