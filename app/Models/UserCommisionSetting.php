<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommisionSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'commision_type',
        'commision_value',
    ];
  
}
