<?php

namespace App\Providers;

use App\Interfaces\GeneralInterface;
use App\Interfaces\UserInterface;
use App\Repository\GeneralRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(GeneralInterface::class, GeneralRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
