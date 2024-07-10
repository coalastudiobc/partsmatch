<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'country',
        'state',
        'city',
        'pin_code',
        'address_type',
        'address1',
        'address2',
        'first_name',
        'last_name',
        'phone_number',
        'shippo_address_id',
    ];
}
