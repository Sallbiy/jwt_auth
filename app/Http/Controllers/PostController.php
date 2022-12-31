<?php

namespace App\Http\Controllers;

use App\Http\Requests\crud\PostStoreRequest;
use App\Http\Requests\crud\PostUpdateRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','show']]);
    }

    public function index()
    {
        $post = Post::all();
        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successful',
            'post' => $post,
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }

    public function update(PostUpdateRequest $request,$id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successful',
            'post' => $post
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successful',
            'post' => $post,
        ]);
    }

}
