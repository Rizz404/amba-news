<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

$subdirectories = File::directories(__DIR__);

foreach ($subdirectories as $directory) {
    $prefix = basename($directory);
    $groupAttributes = [];

    if ($prefix === 'admin') {
        $groupAttributes = [
            'middleware' => ['auth'],
            'prefix'     => 'admin',
            'as'         => 'admin.' // * Ini sama dengan ->name('admin.')
        ];
    }

    // * Semua folder akan masuk ke grup ini,
    // * tapi hanya 'admin' yang punya atribut khusus.
    Route::group($groupAttributes, function () use ($directory) {
        foreach (File::files($directory) as $file) {
            if ($file->getExtension() === 'php') {
                require $file->getPathname();
            }
        }
    });
}
