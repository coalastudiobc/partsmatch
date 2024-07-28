<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = ['name', 'user_id', 'part_number', 'subcategory_id', 'description', 'additional_details', 'stocks_avaliable', 'price', 'shipping_price', 'other_specification', 'Specifications_and_dimensions', 'Shipping_info', 'field_3', 'year', 'brand', 'model', 'status','delete_by'];
    protected $with=['productImage'];
    public function productCompatible()
    {
        return $this->hasMany(ProductCompatabilty::class, 'product_id', 'id');
    }
    public function parcelDetail()
    {
        return $this->hasOne(ProductParcelDetail::class, 'product_id', 'id');
    }
    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function featuredProduct()
    {
        return $this->hasOne(FeaturedProduct::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function cartProduct()
    {
        return $this->belongsTo(CartProduct::class, 'id', 'product_id');
    }
    public function scopeSearch($query)
    {
        $request = request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('name', 'like', '%' . $request->filter_by_name . '%');
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

    public function scopeCategory($query)
    {
        $request = request();
        $query->when(!empty($request->category), function ($q) use ($request) {
            $category = Category::where('id',$request->category)->first();
            $q->whereIn('subcategory_id', $category->categories);
        });
    }

    public function scopePrice($query)
    {
        $request = request();
        $query->when(($request->has('min_value')) , function ($q) use ($request) {
            $q->where('price','>=',$request->min_value);
        })->when(($request->has('max_value')) , function ($q) use ($request) {
            $q->where('price','<=',$request->max_value);
        });
    }

    public function scopeCompatiblity($query)
    {
        $request = request();
        $query->when(($request->has('year') && count($request->year)) , function ($q) use ($request) {
            $q->whereHas('productCompatible', function ($query) use ($request) {
                $query->OrwhereIn('year', $request->year);
            });
        })->when(($request->has('brand') && count($request->brand)) , function ($q) use ($request) {
            $q->whereHas('productCompatible', function ($query) use ($request) {
                $query->OrwhereIn('make', $request->brand);
            });
        })->when(($request->has('model') && count($request->model)) , function ($q) use ($request) {
            $q->whereHas('productCompatible', function ($query) use ($request) {
                $query->OrwhereIn('model', $request->model);
            });
        });
    }

    public function scopeGlobal($query)
    {
        $request = request();
        $query->when(!empty($request->search_parameter), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_parameter . '%')
                    ->orWhere('price', 'like', '%' . $request->search_parameter . '%')
                    ->orWhere('year', 'like', '%' . $request->search_parameter . '%')
                    ->orWhere('brand', 'like', '%' . $request->search_parameter . '%')
                    ->orWhere('part_number', 'like', '%' . $request->search_parameter . '%')
                    ->orWhere('model', 'like', '%' . $request->search_parameter . '%');
            });
        });
    }
}
