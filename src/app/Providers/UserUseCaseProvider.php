<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Applications\User\Handlers\UserGetByEmailHandler;
use Packages\Applications\User\Interface\UserGetByIdInterface;
use Packages\Applications\User\Interface\UserGetByEmailInterface;

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
            fn () => new UserGetByEmailHandler($eloquentUserRepository)
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
