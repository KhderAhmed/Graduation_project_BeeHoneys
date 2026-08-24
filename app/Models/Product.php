<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
     /** @use HasFactory<\Database\Factories\PostFactory> */
     use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_en',
        'description_ar',
        'status',
        'catgory_id',
        'price',
        'image',

    ];

    public function catgory()
    {
        # code...
        return $this->belongsTo(Catgory::class);
    }
}
