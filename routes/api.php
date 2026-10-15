<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\AuthController;

// Autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Publicaciones: operaciones protegidas
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::post('/posts/{post}/like', [PostController::class, 'like']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

// Consulta pública de publicaciones
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

// API versión 1
Route::prefix('v1')->group(function () {

    // Autenticación
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Operaciones que requieren autenticación
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/posts', [PostController::class, 'store']);
        Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
        Route::post('/posts/{post}/like', [PostController::class, 'like']);
        Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    });

    // Consultas públicas
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
});