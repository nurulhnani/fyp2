<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personality_Evaluation extends Model
{
    use HasFactory;
    public $table = 'personality_evaluations';
    protected $fillable = [
        'Extraversion',
        'Agreeableness',
        'Neuroticism',
        'Conscientiousness',
        'Openness',
        'student_mykid',
        'teacher_id'
    ];
}
