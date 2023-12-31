<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // blade directive activrMenu
        \Blade::directive('activeMenu', function ($route) {
            return "{{ Route::is($route) ? 'active' : '' }}";
        });
    }
}
