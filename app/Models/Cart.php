<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'status'
    ];

    public function cart_product()
    {
        return $this->hasOne(CartProduct::class, 'cart_id');
    }
    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class, 'cart_id', 'id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'subcategory_id', 'id');
    }
}
