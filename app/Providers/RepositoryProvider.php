<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Applications\Domain\ApplicationRepositoryInterface;
use Src\Applications\Infrastructure\Eloquent\EloquentApplicationRepository;
use Src\Users\Domain\UserRepositoryInterface;
use Src\Users\Infrastructure\Eloquent\EloquentUserRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
