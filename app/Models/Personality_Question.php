<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Personality_Question extends Model
{
    use HasFactory;
    public $table = 'personality_questions';
    protected $fillable = [
        'category',
        'question',
        'type',
        'ans_choices'
    ];

    protected function ans_choices(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
