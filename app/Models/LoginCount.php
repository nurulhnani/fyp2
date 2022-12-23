<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCount extends Model
{
    use HasFactory;

    protected $table = 'login_count';

    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id','login_counts','login_date'
    ];
}
