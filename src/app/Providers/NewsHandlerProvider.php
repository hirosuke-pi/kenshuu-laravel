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
        $eloquentNewsFactory = new RepositoryNewsFactory(
            userRepository: new EloquentUserRepository(),
            tagRepository: new EloquentTagRepository(),
            imageRepository: new EloquentImageRepository()
        );
        $eloquentNewsRepository = new EloquentNewsRepository();

        $this->app->bind(
            NewsGetHandler::class,
            fn () => new NewsGetHandler($eloquentNewsRepository, $eloquentNewsFactory)
        );
        $this->app->bind(
            NewsGetAllHandler::class,
            fn () => new NewsGetAllHandler($eloquentNewsRepository, $eloquentNewsFactory)
        );
        $this->app->bind(
            NewsCreateInterface::class,
            fn () => new NewsCreateHandler($eloquentNewsRepository, $eloquentNewsFactory)
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
