<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Handlers\User\UserGetByEmailHandler;
use Packages\Handlers\User\UserGetByIdHandler;
use Packages\Handlers\User\UserCreateHandler;

use Packages\Infrastructure\Repositories\EloquentUserRepository;

class UserUseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $eloquentUserRepository = new EloquentUserRepository();

        $this->app->bind(
            UserGetByEmailHandler::class,
            fn () => new UserGetByEmailHandler($eloquentUserRepository)
        );
        $this->app->bind(
            UserGetByIdHandler::class,
            fn () => new UserGetByIdHandler($eloquentUserRepository)
        );
        $this->app->bind(
            UserCreateHandler::class,
            fn () => new UserCreateHandler($eloquentUserRepository)
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
