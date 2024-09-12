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
    public function shippoPurchasedLabel()
    {
        return $this->hasOne(ShippoPurchasedLabel::class,'order_id','id');
    }

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
        $request = $request ?? request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('id',$request->filter_by_name); 
            $q->OrWhere('shipment_price',$request->filter_by_name); 
        });
    }
}
