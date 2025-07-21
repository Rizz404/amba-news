<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ArticleController;

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile/{id}/upgrade-role', [ProfileController::class, 'upgradeRole'])->name('profile.upgrade-role');

Route::middleware(['auth'])->group(function () {
    Route::get('/author', [ArticleController::class, 'index'])->name('user.articles.index');
    Route::get('/author/create', [ArticleController::class, 'create'])->name('user.articles.create');
    Route::post('/author', [ArticleController::class, 'store'])->name('user.articles.store');
    Route::get('/author/{id}/edit', [ArticleController::class, 'edit'])->name('user.articles.edit');
    Route::put('/author/{id}', [ArticleController::class, 'update'])->name('user.articles.update');
    Route::delete('/author/{id}', [ArticleController::class, 'destroy'])->name('user.articles.destroy');
});
