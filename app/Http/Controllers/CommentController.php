<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

        $comment->load('post');

        Notification::route('mail', 'prueba@example.com')
            ->notify(new NewCommentNotification($comment));

        return response()->json($comment, 201);
    }
}