<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::resource('categories', CategoryController::class);
});
