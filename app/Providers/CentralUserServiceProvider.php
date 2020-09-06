<?php

namespace App\Providers;

use App\Repositories\CentralUserRepository;
use App\Repositories\CentralUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CentralUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CentralUserRepositoryInterface::class, CentralUserRepository::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
