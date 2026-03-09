<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::middleware('auth')->group(function () {
    Route::post('/movies/{movie}/like', [MovieController::class, 'toggleLike'])->name('movies.like');
    Route::post('/movies/{movie}/favorite', [MovieController::class, 'toggleFavorite'])->name('movies.favorite');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/movies', [AdminController::class, 'movies'])->name('admin.movies.index');
    Route::get('/movies/create', [AdminController::class, 'createMovie'])->name('admin.movies.create');
    Route::post('/movies', [AdminController::class, 'storeMovie'])->name('admin.movies.store');
});
