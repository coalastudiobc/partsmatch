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

    public function featuredProduct()
    {
        return $this->hasOne(FeaturedProduct::class, 'product_id', 'id');
    }

    public function scopeSearch($query)
    {
        $request = request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            // $q->Where('email', 'like', '%' . $request->filter_by_name . '%');
            $q->orWhere('name', 'like', '%' . $request->filter_by_name . '%');
        })->when(!empty($request->filter_by_name) && $request->filter_by_name == 'active', function ($q) use ($request) {
            $q->where('status', '1');
        })->when(!is_null($request->dates), function ($q) use ($request) {
            $dates = explode(' - ', $request->dates);
            $dateFrom = $dates[0];
            $dateTo = $dates[1];
            $q->where(function ($query) use ($dateFrom, $dateTo) {
                $query->whereDate('created_at', '>=', $dateFrom);
                $query->whereDate('created_at', '<=', $dateTo);
            });
        })->when(!is_null($request->filter_by_status), function ($q) use ($request) {
            $q->where('status', $request->filter_by_status);
        });
    }
}
