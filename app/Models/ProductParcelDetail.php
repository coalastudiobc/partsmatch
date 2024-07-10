<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductParcelDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'length',
        'width',
        'height',
        'weight',
        'distance_unit',
        'mass_unit',
    ];
}
