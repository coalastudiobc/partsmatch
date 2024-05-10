<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'icon',
        'name',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function scopeSearch($query)
    {
        $request = request();
        // dd($request->all());
        $query->when(!empty($request->filter_by_name), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->filter_by_name . '%');
        })->when(!is_null($request->dates), function ($q) use ($request) {
            $dates = explode(' - ', $request->dates);
            $dateFrom = $dates[0];
            $dateTo = $dates[1];
            $q->where(function ($query) use ($dateFrom, $dateTo) {
                $query->whereDate('created_at', '>=', $dateFrom);
                $query->whereDate('created_at', '<=', $dateTo);
            });
        })->get();
    }

    public function children()
    {
        // $test = ->get();
        // dd($test, $this->id);
        return $this->hasMany(self::class, 'parent_id');
    }
}
