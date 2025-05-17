<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Core\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts', [PostController::class, 'index']),
    Route::get('/posts/create', [PostController::class, 'create']),
    Route::post('/posts', [PostController::class, 'store']),

    Route::get('/register', [RegisterController::class, 'create']),
    Route::post('/register', [RegisterController::class, 'store']),


    Route::get('/login', [LoginController::class, 'create']),
    Route::post('/login', [LoginController::class, 'store']),

];