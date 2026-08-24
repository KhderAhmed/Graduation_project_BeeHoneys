<?php

namespace App\Http\Controllers\Services;

use App\Models\ClientRequest;
use Illuminate\Support\Facades\Cache;

class ClientPostService
{
    public function getClientPosts($clientId, $locale, $keyword = null)
    {
        $cacheKey = "client_{$clientId}_blogs_{$locale}_" . md5($keyword);

        return Cache::remember($cacheKey, 60, function () use ($clientId, $locale, $keyword) {
            return ClientRequest::byClientWithLocale($clientId, $locale, $keyword)->paginate(7);
        });
    }
}
