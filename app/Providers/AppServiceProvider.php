<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
    }
}
