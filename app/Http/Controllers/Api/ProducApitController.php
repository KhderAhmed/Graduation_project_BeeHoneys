<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProducApitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = app()->getLocale();
        $blogs = ClientRequest::select('id', 'image', "description_{$locale}", "title_{$locale}")->get();

        if ($blogs->isEmpty()) {
            return response()->json(['message' => 'No Posts Found'], 404);
        }

        return response()->json(['blogs' => $blogs], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title_ar' => 'required|min:3',
            'title_en' => 'required|min:3',
            'description_en' => 'required|min:5',
            'description_ar' => 'required|min:5',
            'image' => 'nullable|image',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $blog = new ClientRequest($request->only(['title_en', 'title_ar', 'description_en', 'description_ar']));
        $blog->client_id = Auth::guard('client')->id();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/blog/'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();

        return response()->json(['message' => 'Post Created Successfully', 'blog' => $blog], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ClientRequest::find($id);

        if (!$product) {
            return response()->json(['message' => 'Post Not Found'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = ClientRequest::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Post Not Found'], 404);
        }

        $rules = [
            'title_ar' => 'required|min:3',
            'title_en' => 'required|min:3',
            'description_en' => 'required|min:5',
            'description_ar' => 'required|min:5',
            'image' => 'nullable|image',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $blog->fill($request->only(['title_en', 'title_ar', 'description_en', 'description_ar']));

        if ($request->hasFile('image')) {
            if ($blog->image) {
                File::delete(public_path('/blog/' . $blog->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/blog/'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();

        return response()->json(['message' => 'Post Updated Successfully', 'blog' => $blog], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = ClientRequest::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Post Not Found'], 404);
        }

        if ($blog->image) {
            File::delete(public_path('/blog/' . $blog->image));
        }

        $blog->delete();

        return response()->json(['message' => 'Post Deleted Successfully'], 200);
    }
}
