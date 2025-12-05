<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL; // Importa a classe URL
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

        // Força o esquema HTTPS para a geração de URLs

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
