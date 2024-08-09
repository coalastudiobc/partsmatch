<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cart_id',
        'order_for',
        'status',
        'shipment_price',
        'total_amount',
        'payment_method',
        'shippment_details',
        'payment_raw_data',
    ];

    protected $casts = [
        'total_amount'=>'float',
    ];

    public function scopeForUser($query, $userId)
    {
        return $query->where('order_for', $userId);
    }

    public function scopeNotFulfilled($query, $fulfilledOrderIds)
    {
        return $query->whereNotIn('id', $fulfilledOrderIds);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function buyerDetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sellerDetail()
    {
        return $this->belongsTo(User::class, 'order_for');
    }

    public function scopeSearch($query)
    {
        $request = request();
        // dd($request);
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('name', 'like', '%' . $request->filter_by_name . '%');
            // $q->orWhere('email', 'like', '%' . $request->filter_by_name . '%');
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
