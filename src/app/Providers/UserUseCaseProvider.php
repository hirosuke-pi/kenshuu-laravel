<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Applications\User\Handlers\UserGetByEmailHandler;
use Packages\Applications\User\Handlers\UserGetByIdHandler;
use Packages\Applications\User\Interfaces\UserGetByIdInterface;
use Packages\Applications\User\Interfaces\UserGetByEmailInterface;

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
            UserGetByEmailInterface::class,
            fn () => new UserGetByEmailHandler($eloquentUserRepository)
        );
        $this->app->bind(
            UserGetByIdInterface::class,
            fn () => new UserGetByIdHandler($eloquentUserRepository)
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
