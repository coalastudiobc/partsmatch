<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address1', 'address2', 'country', 'state', 'city', 'post_code', 'user_id', 'name', 'last_name'
    ];
}
