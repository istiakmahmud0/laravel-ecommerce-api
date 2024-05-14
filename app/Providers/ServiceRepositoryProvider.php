<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterface\AuthRepositoryInterface;
use App\Interfaces\ServiceInterfaces\AuthServiceInterface;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthServiceInterface::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
