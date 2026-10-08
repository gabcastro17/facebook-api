<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['images', 'comments'])->get();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');

                $post->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return response()->json(
            $post->load('images'),
            201
        );
    }

    public function show(Post $post)
    {
        return response()->json(
            $post->load(['images', 'comments'])
        );
    }

    public function like(Post $post)
    {
        $post->increment('likes_count');

        return response()->json([
            'message' => 'Post liked',
            'likes_count' => $post->likes_count,
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }
}