<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'subcategory_id', 'description', 'additional_details', 'stocks_avaliable', 'price', 'shipping_price', 'other_specification', 'year', 'brand', 'model', 'status'];

    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
