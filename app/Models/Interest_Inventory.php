<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest_Inventory extends Model
{
    use HasFactory;
    public $table = 'interest_inventory';
    protected $fillable = [
        'questions',
        'category',
    ];
}
