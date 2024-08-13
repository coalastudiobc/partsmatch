<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserBankDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'user_id',
        'stripe_id',
        'raw_data',
        'country',
    ];
}
