<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LangServices;
use App\Http\Controllers\Services\BlogService;
use App\Models\Blog;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected LangServices $langServices;
    protected BlogService $blogService;

    public function __construct(LangServices $langServices, BlogService $blogService)
    {
        $this->langServices = $langServices;
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $this->langServices->langFunction();
        $locale = app()->getLocale();
        $keyword = $request->input('Keyword');

        $data = $this->blogService->getBlogs($locale, $keyword);
        $requests = $this->blogService->getClientRequests($locale, $keyword);

        return view('blog', compact('data', 'requests'));
    }

    public function showR($reqId)
    {
        $this->langServices->langFunction();
        $req = ClientRequest::findOrFail($reqId);
        return view('clientblogshow', compact('req'));
    }

    public function showA($bloId)
    {
        $this->langServices->langFunction();
        $blo = Blog::findOrFail($bloId);
        return view('adminblogshow', compact('blo'));
    }
}
