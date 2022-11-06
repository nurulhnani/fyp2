<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';  
    // protected $fillable = [
		// 'name', 'mykid','class_id','gender','citizenship','address','G1_name','G1_income','G1_relation','G1_phonenum','G2_income','G2_name','G2_relation','G2_phonenum','G2_income'
	  // ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function class(){
      return $this->hasOne(Classlist::class,'id');
    }
  //   public function classlists(){
  //     return $this->belongsTo(Classlist::class);
  // }
}
