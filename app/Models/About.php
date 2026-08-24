<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_en',
        'description_ar',

    ];
}
