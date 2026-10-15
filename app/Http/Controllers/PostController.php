<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
public function index(Request $request)
{
    $search = $request->query('search');

    $posts = Post::with(['images', 'comments'])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        })
        ->paginate($request->query('per_page', 10));

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

    
    public function like(Request $request, Post $post)
    {
        $like = $post->likes()->firstOrCreate([
          'user_id' => $request->user()->id,
        ]);

        if ($like->wasRecentlyCreated) {
            $post->increment('likes_count');

            return response()->json([
                'message' => 'Like registrado correctamente.',
                'likes_count' => $post->fresh()->likes_count,
            ]);
        }

        return response()->json([
            'message' => 'Ya has dado like a esta publicación.',
            'likes_count' => $post->fresh()->likes_count,
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