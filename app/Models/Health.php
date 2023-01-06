<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $table = 'healths';

    protected $primaryKey = 'id';
    protected $fillable = [
      'student_id','height','weight','health_history','description','medication_allergies','medications_now_taking','chicken_pox','measles','mumps','present_health'
    ];
}
