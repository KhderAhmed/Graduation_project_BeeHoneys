<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeeQuestion extends Model
{
    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
    ];
}
