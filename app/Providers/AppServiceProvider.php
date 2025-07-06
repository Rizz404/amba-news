<?php

namespace App\Providers;

use App\Services\CloudinaryService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CloudinaryService::class, function ($app) {
            return new CloudinaryService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // * Di layout
        Blade::component('components.layouts.app', 'app');
        Blade::component('components.layouts.user', 'user-layout');
        Blade::component('components.layouts.admin', 'admin-layout');


        // * Di layout parts
        Blade::component('components.partials.admin-header', 'admin-header');
        Blade::component('components.partials.admin-sidebar', 'admin-sidebar');

        if (env('CURL_CA_BUNDLE')) {
            putenv('CURL_CA_BUNDLE=' . env('CURL_CA_BUNDLE'));

            if (!defined('CURLOPT_CAINFO')) {
                define('CURLOPT_CAINFO', env('CURL_CA_BUNDLE'));
            }
        }
    }
}
