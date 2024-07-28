<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippmentAddressDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'shippment_date',
        'selected_shippo_address',
        'order_id',
        'user_id',
    ];
    public function selectedAddress(){
        return $this->hasOne(UserAddresses::class, 'shippo_address_id','selected_shippo_address');
    }
}
