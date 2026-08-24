<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HiveReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'hive_id',
        'temperature',
        'humidity',
        'weight',
        'co2',
    ];

    // العلاقة مع Hive
    public function hive()
    {
        return $this->belongsTo(Hive::class);
    }
}
