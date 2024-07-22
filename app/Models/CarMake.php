<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{
    use HasFactory;
    protected $fillable=['year_id','make_id','value'];

    public function getYearIdAttribute($value)
    {
        return (int) $value;
    }

    public function carYear()
    {
        return $this->hasOne(CarYear::class, 'id', 'year_id');
    }

}
