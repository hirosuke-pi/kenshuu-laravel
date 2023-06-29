<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;

use Packages\Applications\News\Handlers\NewsGetAllHandler;
use Packages\Applications\News\Handlers\NewsGetHandler;
use Packages\Applications\News\Handlers\NewsCreateHandler;
use Packages\Applications\News\UseCases\NewsGetUseCase;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;
use Packages\Applications\News\UseCases\NewsCreateUseCase;

class NewsUseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $eloquentNewsRepository = new EloquentNewsRepository(
            userRepository: new EloquentUserRepository(),
            tagRepository: new EloquentTagRepository(),
            imageRepository: new EloquentImageRepository()
        );

        $this->app->bind(
            NewsGetUseCase::class,
            fn () => new NewsGetHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsGetAllUseCase::class,
            fn () => new NewsGetAllHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsCreateUseCase::class,
            fn () => new NewsCreateHandler($eloquentNewsRepository)
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
