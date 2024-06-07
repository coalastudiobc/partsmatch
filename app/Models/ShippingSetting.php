<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'range_to',
        'range_from',
        'type',
    ];
}
