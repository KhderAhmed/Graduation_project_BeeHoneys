<?php

namespace App\Http\Controllers\Services;

use App\Models\Blog;
use App\Models\ClientRequest;

class BlogService
{
    public function getBlogs($locale, $keyword, $perPage = 10)
    {
        return Blog::with('user')
            ->select("id", "user_id", "image", "description_{$locale}", "title_{$locale}")
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title_en', 'like', "%{$keyword}%")
                        ->orWhere('title_ar', 'like', "%{$keyword}%");
                });
            })
            ->where('status', 1)
            ->paginate($perPage);
    }

    public function getClientRequests($locale, $keyword, $perPage = 10)
    {
        return ClientRequest::with('client') // نفس الشيء لو عندهم علاقة
            ->select("id", "client_id", "image", "description_{$locale}", "title_{$locale}")
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title_en', 'like', "%{$keyword}%")
                        ->orWhere('title_ar', 'like', "%{$keyword}%");
                });
            })
            ->where('status', 1)
            ->paginate($perPage);
    }
}
