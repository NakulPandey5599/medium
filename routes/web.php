<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

Route::get('/', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/post/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('post.store');
Route::get('/@{username}/{post:slug}',[PostController::class, 'show'])->name('post.show');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
