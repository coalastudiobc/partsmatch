<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'page_content',
        'page_title',
        'media_name',
        'media_url',
        'status',
    ];
}
