<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/user/{id}', [ProfileController::class, 'show']);