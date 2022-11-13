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
      'class_name'
    ];

    public function students(){
      return $this->belongsTo(Student::class,'id');
    }
    public function teachers(){
      return $this->belongsTo(Teacher::class, 'id');
    }
    // public function teacher(){
    //   return $this->hasOne(Teacher::class);
    // }
    
}
