<?php

namespace App\Providers;

use App\Services\TransactionStatService;
use Illuminate\Support\ServiceProvider;

class TransactionStatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TransactionStatService::class, function ($app) {
            return new TransactionStatService($app);
        });
    }
}
