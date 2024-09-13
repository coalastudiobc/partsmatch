<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCompatabilty extends Model
{
    use HasFactory;
    protected $fillable = ['make', 'model', 'year', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
