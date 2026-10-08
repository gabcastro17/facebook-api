<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'author' => 'required|string',
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'author' => $request->author,
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }
}