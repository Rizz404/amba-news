<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::resource('articles', LandingController::class);

