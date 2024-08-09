<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FulFilledOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'fullfilled_ship_id',
        'user_id'
    ];
    public function scopeFulFilledOrders($query)
    {
        return $query->where('user_id', auth()->id())->latest();
    }
    public function orderDetails()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function scopeForUser($query, $userId)
    {
        $orderIds = Order::forUser($userId)->pluck('id');
        return $query->whereIn('order_id', $orderIds)->pluck('order_id');
    }
}
