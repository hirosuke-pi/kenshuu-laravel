<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;

use Packages\Handlers\News\NewsGetAllHandler;
use Packages\Handlers\News\NewsGetHandler;
use Packages\Handlers\News\NewsCreateHandler;

class NewsHandlerProvider extends ServiceProvider
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
            NewsGetHandler::class,
            fn () => new NewsGetHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsGetAllHandler::class,
            fn () => new NewsGetAllHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsCreateInterface::class,
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
