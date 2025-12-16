<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // TU MUSI BYĆ 'text', A NIE 'content'
    protected $fillable = [
        'quiz_id', 
        'text', 
        'answer_a', 
        'answer_b', 
        'answer_c', 
        'answer_d', 
        'correct_answer'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}