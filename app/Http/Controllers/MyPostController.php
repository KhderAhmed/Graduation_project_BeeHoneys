<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LangServices;
use App\Http\Controllers\Services\ImageService;
use App\Http\Controllers\Services\ClientPostService;
use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class MyPostController extends Controller
{
    protected LangServices $langServices;
    protected ImageService $imageService;
    protected ClientPostService $postService;

    public function __construct(LangServices $langServices, ImageService $imageService, ClientPostService $postService)
    {
        $this->langServices = $langServices;
        $this->imageService = $imageService;
        $this->postService = $postService;
    }

    private function prepareLocale(): void
    {
        $this->langServices->langFunction();
    }

    public function index(Request $request)
    {
        $this->langServices->langFunction();

        $blogs = collect();

        if ($clientId = Auth::guard('client')->id()) {
            $locale = app()->getLocale();
            $keyword = $request->input('Keyword');

            $blogs = $this->postService->getClientPosts($clientId, $locale, $keyword);
        }

        return view('auth.profile.my_post.index', compact('blogs'));
    }

    public function create()
    {
        $this->prepareLocale();
        return view('auth.profile.my_post.create');
    }


    public function store(StoreClientRequest $request)
    {
        $blog = new ClientRequest($request->only([
            'title_ar',
            'title_en',
            'description_ar',
            'description_en'
        ]));

        $blog->client_id = Auth::guard('client')->id();
        $blog->save();

        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadImage($request->file('image'));
            $blog->update(['image' => $imageName]);
        }

        return redirect()->route('post.index')->with('success', __('messages.created_post_success'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        $blog = ClientRequest::findOrFail($id);

        $blog->update($request->only([
            'title_ar',
            'title_en',
            'description_ar',
            'description_en'
        ]));

        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadImage($request->file('image'), $blog->image);
            $blog->update(['image' => $imageName]);
        }

        return redirect()->route('post.index')->with('success', __('messages.updated_post_success'));
    }

    public function destroy($id)
    {
        $blog = ClientRequest::findOrFail($id);

        if ($blog->image) {
            $this->imageService->deleteImage($blog->image);
        }

        $blog->delete();

        return redirect()->back()->with('success', __('messages.deleted_post_success'));
    }

    public function edit($id)
    {
        $this->prepareLocale();
        $blog = ClientRequest::findOrFail($id);

        return view('auth.profile.my_post.editpost', compact('blog'));
    }
}
