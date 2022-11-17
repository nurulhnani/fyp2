<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Subject_details extends Model
{
    use HasFactory;

    protected $table = 'subject_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'subject_id', 'classlist_id','teacher_id'
      ];

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }
    public function teachers(){
        return $this->belongsTo(Teacher::class);
    }
}
