<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject_details;

class Subject extends Model
{
    // use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['subject_name','grade'];
  
    public function subject_details(){
      return $this->hasMany(Subject_details::class);
    }
      
}
