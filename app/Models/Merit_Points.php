<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merit_Points extends Model
{
    use HasFactory;
    public $table = 'merit_points';
    protected $fillable = [
        'category',
        'level',
        'achievement',
        'merit_points',
    ];
}
