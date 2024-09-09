<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerPayout extends Model
{
    use HasFactory;
    protected $fillable=[
        'dealer_id',
        'transaction_id',
        'order_id',
        'amount',
        'currency',
        'gateway_response',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
