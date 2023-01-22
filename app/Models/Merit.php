<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merit extends Model
{
    use HasFactory;
    public $table = 'merits';
    protected $fillable = [
        'type',
        'category',
        'merit_name',
        'merit_point',
        'student_mykid',
        'level',
        'achievement',
        'desc',
        'date',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_mykid', 'mykid');
    }
}
