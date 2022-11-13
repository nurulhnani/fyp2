<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoFields extends Model
{
    use HasFactory;

    protected $table='customfield';
    protected $primaryKey = 'id';
    protected $fillable = ['user','name','type','dropdownNote'];
}
