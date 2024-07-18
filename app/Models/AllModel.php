<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllModel extends Model
{
    use HasFactory;
    protected $fillable=['model_id','make_table_id','value'];

}
