<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrandMake extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_url',
        'image_name',
        'makes',
    ];
    public function scopeSearch($query)
    {
        $request = request();
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->Where('makes', 'like', '%' . $request->filter_by_name . '%');
        });
    }
}
