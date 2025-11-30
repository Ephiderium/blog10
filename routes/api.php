<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

    Route::post('/posts', [PostController::class,'index'])->name('posts.index');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/store', [PostController::class,'store'])->name('posts.store');
    Route::patch('/posts/{id}', [PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class,'destroy'])->name('posts.destroy');

    Route::get('/comments/{id}', [CommentController::class,'show'])->name('comments.show');
    Route::post('/comments', [CommentController::class,'store'])->name('comments.store');
    Route::patch('/comments/{id}', [CommentController::class,'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class,'destroy'])->name('comments.destroy');

    Route::post('/likes', [LikeController::class,'store'])->name('likes.store');
    Route::delete('/likes/{id}', [LikeController::class,'destroy'])->name('likes.destroy');

    Route::get('/users/id/{id}', [UserController::class,'show'])->name('users.show.id');
    Route::get('/users/email/{email}', [UserController::class,'showByEmail'])->name('users.show.email');
    Route::patch('/users/{id}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class,'destroy'])->name('users.destroy');

    Route::get('/categories', [DataController::class,'getCategories'])->name('getCategories');
});
