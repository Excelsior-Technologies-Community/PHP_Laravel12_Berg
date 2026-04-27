<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);

// TRASH SYSTEM
Route::get('/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::post('/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('posts.forceDelete');