<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Handlers\News\NewsGetByUserHandler;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;

use Packages\Handlers\News\NewsGetAllHandler;
use Packages\Handlers\News\NewsGetHandler;
use Packages\Handlers\News\NewsCreateHandler;
use Packages\Handlers\News\NewsEditHandler;

class NewsHandlerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $eloquentNewsFactory = new RepositoryNewsFactory(
            userRepository: $userRepository,
            tagRepository: $tagRepository,
            imageRepository: $imageRepository
        );
        $eloquentNewsRepository = new EloquentNewsRepository($tagRepository, $imageRepository, $userRepository);

        $this->app->bind(
            RepositoryNewsFactory::class,
            fn () => $eloquentNewsFactory
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
            NewsCreateHandler::class,
            fn () => new NewsCreateHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsGetByUserHandler::class,
            fn () => new NewsGetByUserHandler($eloquentNewsRepository)
        );
        $this->app->bind(
            NewsEditHandler::class,
            fn () => new NewsEditHandler($eloquentNewsRepository)
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
