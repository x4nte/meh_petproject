<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Core\Router\Route;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

return [
    Route::get('/', [HomeController::class, 'index'])->middleware(AuthMiddleware::class),
    Route::get('/posts', [PostController::class, 'index'])->middleware(AuthMiddleware::class),
    Route::get('/posts/create', [PostController::class, 'create'])->middleware(AuthMiddleware::class),
    Route::get('/posts/{postId}', [PostController::class, 'show'])->middleware(AuthMiddleware::class),
    Route::patch('/posts/{postId}', [PostController::class, 'update'])->middleware(AuthMiddleware::class),
    Route::get('/posts/{postId}/edit', [PostController::class, 'edit'])->middleware(AuthMiddleware::class),
    Route::delete('/posts/{postId}', [PostController::class, 'destroy'])->middleware(AuthMiddleware::class),
    Route::post('/posts', [PostController::class, 'store'])->middleware(AuthMiddleware::class),


    Route::get('/register', [RegisterController::class, 'create'])->middleware(GuestMiddleware::class),
    Route::post('/register', [RegisterController::class, 'store'])->middleware(GuestMiddleware::class),

    Route::get('/login', [LoginController::class, 'create'])->middleware(GuestMiddleware::class),
    Route::post('/login', [LoginController::class, 'store'])->middleware(GuestMiddleware::class),

    Route::post('/logout', [LoginController::class, 'destroy']),

];