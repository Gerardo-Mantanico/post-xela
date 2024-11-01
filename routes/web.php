<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportPostController;
use App\Http\Controllers\AttendEventController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'banned',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/category', function () {
        return view('category.category');
    })->name('category');
    Route::get('/authpost', function () {
        return view('admin.authPost.authPost');
    })->name('authPost');
    Route::get('/reportsPost', function () {
        return view('admin.reportPost.reportPost');
    })->name('reportsPost');

    Route::get('/events', function () {
        return view('events.events');
    })->name('events');

    // Route::resource('categories', CategoryController::class)->names('categories')->middleware('admin');
    Route::resource('posts', PostController::class)->names('posts');
    Route::get('/new-post', function () {
        return view('new-post');
    })->name('new-post');
    Route::resource('reportPost', ReportPostController::class)->names('reportPost');
    Route::resource('attendEvent', AttendEventController::class)->names('attendEvent');
    // Route::resource('categories', CategoryController::class)->names('categories')->middleware('admin');
    Route::resource('posts', PostController::class)->names('posts');
    // Route::resource('reportPost', ReportPostController::class)->names('reportPost');
    Route::get('posts/publication', [PostController::class, 'publication'])->name('posts.publication');
});
