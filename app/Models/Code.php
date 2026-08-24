<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = ['code', 'created_by', 'beekeeper_id', 'is_redeemed', 'redeemed_at', 'expires_at'];

    public static function generate($length = 8): string
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (self::where('code', $code)->exists());
        return $code;
    }

    public function beekeeper()
    {
        return $this->belongsTo(Beekeeper::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
