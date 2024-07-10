<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippmentCreation extends Model
{
    use HasFactory;
    protected $fillable = [
        'shippment_date',
        'address_to',
        'address_from',
        'shippment_id',
        'product_id',
        'user_id',
        'parcel_id',
    ];
    protected $appends = ['product_of'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function getProductOfAttribute()
    {
        return optional($this->product)->user_id;
    }
}
