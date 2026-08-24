<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactme extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'phone',
        'status'
    ];
}
