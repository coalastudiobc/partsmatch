<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = ['name', 'user_id', 'part_number', 'subcategory_id', 'description', 'additional_details', 'stocks_avaliable', 'price', 'shipping_price', 'other_specification', 'Specifications_and_dimensions', 'Shipping_info', 'field_3', 'year', 'brand', 'model', 'status','delete_by','dealer_id'];
    protected $with=['productImage'];
    public function productCompatible()
    {
        return $this->hasMany(ProductCompatabilty::class, 'product_id', 'id');
    }
    public function featuredByUsers()
    {
        return $this->belongsToMany(User::class, 'featured_products', 'product_id', 'user_id')
                    ->withTimestamps();
    }

    public function productOfDealer()
    {
        return $this->hasMany(User::class,'id' ,'dealer_id');
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
    public function scopeSearch($query,$request = null)
    {
        $request = $request ?? request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('name', 'like', '%' . $request->filter_by_name . '%');
            $q->orWhere('part_number', 'like', '%' . $request->filter_by_name . '%');
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

    public function scopeCategory($query,$request = null)
    {
        $request = $request ?? request();
        $query->when(!empty($request->category), function ($q) use ($request) {
            $category = Category::where('id',$request->category)->first();
            $q->whereIn('subcategory_id', $category->categories);
        });
    }

    public function scopePrice($query,$request = null)
    {
        $request = $request ?? request();
        $query->when(($request->has('min_value')) , function ($q) use ($request) {
            $q->where('price','>=',$request->min_value);
        })->when(($request->has('max_value')) , function ($q) use ($request) {
            $q->where('price','<=',$request->max_value);
        });
    }

    public function scopeCompatiblity($query,$request = null)
    {
        $request = $request ?? request();
            // if($request->has('globalquery'))
            // {
            //     $query->when(($request->has('year') && count($request->year)) , function ($q) use ($request) {
            //         $q->whereHas('productCompatible', function ($query) use ($request) {
            //             $query->whereIn('year', $request->year);
            //         });
            //     })->when(($request->has('brand') && count($request->brand)) , function ($q) use ($request) {
            //         $q->whereHas('productCompatible', function ($query) use ($request) {
            //             $query->whereIn('make', $request->brand);
            //         });
            //     })->when(($request->has('model') && count($request->model)) , function ($q) use ($request) {
            //         $q->whereHas('productCompatible', function ($query) use ($request) {
            //             $query->whereIn('model', $request->model);
            //         });
            //     });
            // }else {
            //     $query->when(($request->has('year') && count($request->year)) , function ($q) use ($request) {
            //     $q->whereHas('productCompatible', function ($query) use ($request) {
            //         $query->whereIn('year', $request->year);
            //     });
            // })->when(($request->has('brand') && count($request->brand)) , function ($q) use ($request) {
            //     $q->whereHas('productCompatible', function ($query) use ($request) {
            //         // $query->OrwhereIn('make', $request->brand);
            //         $query->whereIn('make', $request->brand)->with(['productCompatible' => function ($query) use ($request) {
            //             $query->whereIn('make', $request->brand);
            //         }]);
            //     });
            // })->when(($request->has('model') && count($request->model)) , function ($q) use ($request) {
            //     $q->whereHas('productCompatible', function ($query) use ($request) {
            //         $query->whereIn('model', $request->model);
            //     });
            // });
        
            if ($request->has('globalquery')){
               return $query->orWhereHas('productCompatible', function ($query) use ($request) {
                    if ($request->has('globalquery')) {
                        $query->whereIn('year', [$request->globalquery]);
                        $query->orWhereIn('make', [$request->globalquery]);
                        $query->orWhereIn('model', [$request->globalquery]);
                    }
                    })  
                    ->with(['productCompatible' => function ($query) use ($request) {
                        if ($request->has('globalquery')) {
                            $query->whereIn('year', [$request->globalquery]);
                            $query->orWhereIn('make', [$request->globalquery]);
                            $query->orWhereIn('model', [$request->globalquery]);
                        }
                
                    }]);
            } else {
                $query->whereHas('productCompatible', function ($query) use ($request) {
                    if ($request->has('year') && count($request->year)) {
                        $query->whereIn('year', $request->year);
                    }
                    if ($request->has('brand') && count($request->brand)) {
                        $query->whereIn('make', $request->brand);
                    }
                    if ($request->has('model') && count($request->model)) {
                        $query->whereIn('model', $request->model);
                    }
                })
                ->with(['productCompatible' => function ($query) use ($request) {
                    if ($request->has('year') && count($request->year)) {
                        $query->whereIn('year', $request->year);
                    }
                    if ($request->has('brand') && count($request->brand)) {
                        $query->whereIn('make', $request->brand);
                    }
                    if ($request->has('model') && count($request->model)) {
                        $query->whereIn('model', $request->model);
                    }
                }]);
            }
            
    }
   
    public function scopeFilterCompatiblity($query, $request = null)
    {
        $request = $request ?? request();
        $query->where(function ($q) use ($request) {
            if ($request->has('model') && count($request->model)) {
                $q->whereHas('productCompatible', function ($query) use ($request) {
                    $query->whereIn('model', $request->model);
                });
            }
            if ($request->has('brand') && count($request->brand)) {
                $q->orWhereHas('productCompatible', function ($query) use ($request) {
                    $query->whereIn('make', $request->brand);
                });
            }
            if ($request->has('year') && count($request->year)) {
                $q->orWhereHas('productCompatible', function ($query) use ($request) {
                    $query->whereIn('year', $request->year);
                });
            }
        });
    }

    


    public function scopeGlobal($query,$request = null)
    {
        $request = $request ?? request();
        $query->when(!empty($request->globalquery), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('price', 'like', '%' .  $request->globalquery. '%')
                    ->orWhere('part_number', 'like', '%' .  $request->globalquery. '%');
            });
        });
    }
    public function scopeSort($query,$request = null)
    {
        $request = $request ?? request();
        $query->when(($request->has('sortorder')) , function ($q) use ($request) {
            switch ($request->sortorder) {
                case 'low':
                    $q->orderBy('price','asc');
                    break;
                
                case 'high':
                    $q->orderBy('price','desc');
                    break;
                
                case 'new':
                    $q->orderBy('created_at','desc');
                    break;
                
                case 'old':
                    $q->orderBy('created_at','asc');
                    break;
                
                default:
                $q->orderBy('id','desc');
                    break;
            }});
    }

    // public function scopeFilterCompatiblity($query,$request = null)
        // {
        //     $request = $request ?? request();
        //         $query->when(($request->has('year') && count($request->year)) , function ($q) use ($request) {
        //             $q->whereHas('productCompatible', function ($query) use ($request) {
        //                 $query->whereIn('year', $request->year);
        //             });
        //         })->when(($request->has('brand') && count($request->brand)) , function ($q) use ($request) {
        //             $q->whereHas('productCompatible', function ($query) use ($request) {
        //                 $query->whereIn('make', $request->brand);
        //             });
        //         })->when(($request->has('model') && count($request->model)) , function ($q) use ($request) {
        //             $q->whereHas('productCompatible', function ($query) use ($request) {
        //                 $query->whereIn('model', $request->model);
        //             });
        //         });
        // }
}
