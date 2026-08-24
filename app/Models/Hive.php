<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'beekeeper_id'
    ];

    // العلاقة مع HiveReading
    public function readings()
    {
        return $this->hasMany(HiveReading::class);
    }
    public function user()
    {
        return $this->belongsTo(Beekeeper::class);
    }
    public function latestReading()
    {
        return $this->hasOne(HiveReading::class)->latestOfMany();
    }
}
