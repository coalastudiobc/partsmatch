<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderParcels extends Model
{
    use HasFactory;
    protected $fillable = [
        'parcel_id',
        'product_id',
        'orderItem_id',
    ];
}
