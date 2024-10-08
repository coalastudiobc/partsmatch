<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Billable, HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'user_details_id',
        'working_for',
        'profile_picture_file',
        'profile_picture_url',
        'phone_number',
        'industry_type',
        'address',
        'zipcode',
        'email_verification_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function paymentDetail()
    {
        return $this->hasOne(PaymentDetail::class, 'user_id', 'id');
    }
    public function ComissionDetails()
    {
        return $this->hasOne(UserCommisionSetting::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,  'user_id', 'id');
    }
    public function subscription()
    {
        return $this->hasMany(Subscription::class,  'user_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class, 'user_id');
    }

    public function scopeManagers($query)
    {
        return $query->role('Manager');
    }

    public function scopeDealers($query)
    {
        return $query->role('dealer');
    }

    public function scopeSearch($query)
    {
        $request = request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('email', 'like', '%' . $request->filter_by_name . '%');
            $q->orWhere('name', 'like', '%' . $request->filter_by_name . '%');
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
