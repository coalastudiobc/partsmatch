<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePaymentDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'plan_id',
        'plan_name',
        'plan_amount',
        'plan_type',
        'plan_product_count',
        'transcation_id',
        'stripe_raw_data',
        'expire_at',
    ];
}
