<?php

use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::resource('articles', ArticleController::class);
});
