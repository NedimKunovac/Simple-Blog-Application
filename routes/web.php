<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('posts.index');
    }
    return redirect()->route('login');
});

// 1. AUTHENTICATED ROUTES FIRST (Catches /posts/create)
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts (Create, Store, Edit, Update, Destroy)
    Route::resource('posts', PostController::class)->except(['index', 'show']);

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// 2. PUBLIC ROUTES LAST (Catches /posts/{post})
Route::resource('posts', PostController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';