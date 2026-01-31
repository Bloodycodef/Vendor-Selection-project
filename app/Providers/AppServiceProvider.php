<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        // Atur default string length untuk MySQL
        Schema::defaultStringLength(191);

        // Paksa HTTPS di production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Untuk development, set cache driver ke file jika database cache error
        if ($this->app->environment('local') && config('cache.default') === 'database') {
            config(['cache.default' => 'file']);
        }
    }
}
