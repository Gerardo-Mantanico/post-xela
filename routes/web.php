<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; // Asegúrate de tener esta línea
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/new-post', function () {
        return view('new-post');
    })->name('new-post');

    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('posts', PostController::class)->names('posts');
});
