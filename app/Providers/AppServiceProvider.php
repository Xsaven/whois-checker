<?php

namespace App\Providers;

use App\Contracts\WhoisServiceContractInterface;
use App\Services\WhoisService;
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
        $this->app->singleton(WhoisServiceContractInterface::class, WhoisService::class);
    }
}
