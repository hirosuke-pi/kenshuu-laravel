<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Applications\User\Handlers\UserGetByEmailHandler;
use Packages\Applications\User\UseCases\UserGetByIdUseCase;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

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
            UserGetByEmailUseCase::class,
            fn () => new UserGetByEmailHandler($eloquentUserRepository)
        );
        $this->app->bind(
            UserGetByIdUseCase::class,
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
