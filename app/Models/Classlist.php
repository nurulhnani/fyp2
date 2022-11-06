<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classlist extends Model
{
    use HasFactory;

    protected $table = 'classlists';

    protected $primaryKey = 'id';
    protected $fillable = [
        'class_name','femaleStudent','maleStudent','classroom_teacher'
      ];

      public function students(){
        return $this->belongsTo(Student::class,'id');
      }
}
