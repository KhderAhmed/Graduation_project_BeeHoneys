<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ClientRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_en',
        'description_ar',
        'status',
        'image',
        'client_id',

    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
  
    public function scopeByClientWithLocale($query, $clientId, $locale, $keyword = null)
    {
        return $query->select([
            'id',
            'client_id',
            'created_at',
            'updated_at',
            'image',
            "title_ar",
            "title_en",
            "description_ar",
            "description_en"
        ])
            ->where('client_id', $clientId)
            ->when($keyword, function ($q) use ($keyword) {
                $q->where(function ($q) use ($keyword) {
                    $q->where('title_en', 'like', "%$keyword%")
                        ->orWhere('title_ar', 'like', "%$keyword%");
                });
            })
            ->latest();
    }
}
