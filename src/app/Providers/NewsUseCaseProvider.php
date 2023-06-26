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
use Packages\Applications\News\UseCases\NewsGetUseCase;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;

class NewsUseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $eloquentNewsRepository = new EloquentNewsRepository(
            newsFactory: new RepositoryNewsFactory(
                userRepository: new EloquentUserRepository(),
                tagRepository: new EloquentTagRepository(),
                imageRepository: new EloquentImageRepository()
            )
        );

        $this->app->bind(
            NewsGetUseCase::class,
            fn () => new NewsGetHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsGetAllUseCase::class,
            fn () => new NewsGetAllHandler($eloquentNewsRepository)
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
