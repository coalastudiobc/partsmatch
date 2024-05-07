<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'status', 'shipment_price', 'total_amount', 'payment_method'
    ];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
