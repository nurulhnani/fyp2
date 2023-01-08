<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profile_Request extends Model
{
  use HasFactory;

  protected $table = 'profile_requests';
  protected $fillable = [
    'changes','student_mykid', 'status'

    // 'address', 'G1_name', 'G1_relation', 'G1_phonenum', 'G1_income', 'G2_name', 'G2_relation', 'G2_phonenum', 'G2_income', 'image_path', 'student_mykid', 'status'
  ];

  protected function changes(): Attribute
  {
      return Attribute::make(
          get: fn ($value) => json_decode($value, true),
          set: fn ($value) => json_encode($value),
      );
  } 

  public function student()
  {
    return $this->belongsTo(Student::class, 'student_mykid', 'mykid');
  }
}
