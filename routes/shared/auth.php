<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');
  Route::post('/login', [AuthController::class, 'login']);
  Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');
  Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
  ->middleware('auth')
  ->name('logout');
