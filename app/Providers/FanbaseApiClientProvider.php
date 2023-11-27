<?php

namespace App\Providers;

use FanbaseApiClient\Api\FavouriteApi;
use FanbaseApiClient\Api\ReviewApi;
use FanbaseApiClient\Configuration;
use Illuminate\Support\ServiceProvider;

class FanbaseApiClientProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FavouriteApi::class, function ($app) {
            $config = new Configuration();
            $host = config('api_clients.ram_fanbase_api_uri');
            $config->setHost($host);

            return new FavouriteApi(config: $config);
        });
        $this->app->singleton(ReviewApi::class, function ($app) {
            $config = new Configuration();
            $host = config('api_clients.ram_fanbase_api_uri');
            $config->setHost($host);

            return new ReviewApi(config: $config);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
