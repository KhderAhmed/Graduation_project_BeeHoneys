<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

//    protected $guarded = ['id'];
//
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_en',
        'description_ar',
        'status',
        'image',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
