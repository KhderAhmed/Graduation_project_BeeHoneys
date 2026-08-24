<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catgory extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'status'

    ];

    public function products()
    {
        # code...
        return $this->hasMany(Product::class);
    }
}
