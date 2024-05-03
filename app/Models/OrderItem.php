<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'order_id', 'quantity', 'product_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'product_id');
    }

    // public function scopeSearch($query)
    // {
    //     $request = request();
    //     // dd($request);
    //     $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
    //         $q->Where('name', 'like', '%' . $request->filter_by_name . '%');
    //         // $q->orWhere('email', 'like', '%' . $request->filter_by_name . '%');
    //     })->when(!empty($request->filter_by_name) && $request->filter_by_name == 'active', function ($q) use ($request) {
    //         $q->where('status', '1');
    //     })->when(!is_null($request->dates), function ($q) use ($request) {
    //         $dates = explode(' - ', $request->dates);
    //         $dateFrom = $dates[0];
    //         $dateTo = $dates[1];
    //         $q->where(function ($query) use ($dateFrom, $dateTo) {
    //             $query->whereDate('created_at', '>=', $dateFrom);
    //             $query->whereDate('created_at', '<=', $dateTo);
    //         });
    //     })->when(!is_null($request->filter_by_status), function ($q) use ($request) {
    //         $q->where('status', $request->filter_by_status);
    //     });
    // }
}
