<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description','product_count', 'billing_cycle', 'trial_days', 'stripe_id', 'stripe_price', 'status'];
}
