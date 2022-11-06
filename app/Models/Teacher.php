<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject_details;

class Teacher extends Model
{
    // use HasFactory;
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    // protected $fillable = ['subject_name'];

    protected $fillable = ['status','name', 'nric','gender', 'email','position','address','subject_taught','phone_number','image_path'];

  public function subjects_details(){
    return $this->hasMany(Subject_details::class);
  }
  // public function subject_details(){
  //   return $this->hasMany(Subject_details::class,'subject_id','id');
  // }
}
