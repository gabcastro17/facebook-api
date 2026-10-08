<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{post}', [PostController::class, 'show']);

Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

Route::post('/posts/{post}/like', [PostController::class, 'like']);

Route::delete('/posts/{post}', [PostController::class, 'destroy']);