<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/post/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('post.create');
Route::get('/post/store', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('post.store');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
