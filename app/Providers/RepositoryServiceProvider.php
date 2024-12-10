<?php

namespace App\Providers;

use App\Repositories\Contracts\TeamRepositoryContracts;
use App\Repositories\Contracts\UserRepositoryContracts;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryContracts::class,
            UserRepository::class
        );
        $this->app->bind(
            TeamRepositoryContracts::class,
            TeamRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
