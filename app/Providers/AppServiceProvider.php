<?php

namespace App\Providers;

use App\Services\RickAndMortyApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RickAndMortyApiService::class, function ($app) {
            $endpoint = config('services.rick_and_morty_api.endpoint');

            return new RickAndMortyApiService($endpoint);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
