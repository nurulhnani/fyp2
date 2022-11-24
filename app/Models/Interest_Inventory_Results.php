<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest_Inventory_Results extends Model
{
    use HasFactory;
    protected $table = 'interest_inventory_results';
    protected $primaryKey = 'id';
    // protected $fillable = ['subject_name'];

    protected $fillable = ['student_id','realistic','investigative','artistic','social','enterprising','conventional'];

    // public function subjects_details(){
    //   return $this->hasMany(Subject_details::class);
    // }
    public function students(){
      return $this->hasMany(Student::class);
    }
}
