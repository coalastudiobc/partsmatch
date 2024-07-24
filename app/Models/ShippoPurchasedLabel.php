<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippoPurchasedLabel extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate_id',
        'shippment_id',
        'amount',
        'order_id',
        'currency',
        'rate_provider',
        'service_level_token',
        'days',
        'result',
        'master_rateId',
        'tracking_number',
        'tracking_url',
        'label_url',
        'qr_code_url',
    ];
    public function productsOfshippment()
    {
        return $this->hasMany(ShippmentCreation::class, 'shippment_id', 'shippment_id');
    }
}
