<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ================= PUBLIC =================
Route::get('/', [GameController::class, 'index'])->name('home');
Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::get('/games/{game}', [GameController::class, 'show'])
    ->whereNumber('game')
    ->name('games.show');

Route::get('/games/{game}/play', [GameController::class, 'play'])
    ->whereNumber('game')
    ->name('games.play');

// ================= AUTH =================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ================= PROTECTED =================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // HANYA CRUD
    Route::resource('games', GameController::class)
        ->except(['show']);

    Route::middleware('can:viewAny,App\Models\User')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });
});
