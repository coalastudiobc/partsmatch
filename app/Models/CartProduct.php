<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'cart_id', 'product_price', 'quantity'
    ];
    protected $appends = ['product_of'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getProductOfAttribute()
    {
        return optional($this->product)->user_id;
    }
    // public function product()
    // {
    //     return $this->hasOne(Product::class,  'id', 'product_id');
    // }

    public function getEncryptIdAttribute()
    {
        return "test";
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
