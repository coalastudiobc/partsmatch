<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'selected_method_id',
        'shippo_address_id',
        'shipping_address_table_id',
    ];
}
