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
        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $eloquentNewsFactory = new RepositoryNewsFactory(
            userRepository: $userRepository,
            tagRepository: $tagRepository,
            imageRepository: $imageRepository
        );
        $eloquentNewsRepository = new EloquentNewsRepository($tagRepository, $imageRepository);

        $this->app->bind(
            NewsGetHandler::class,
            fn () => new NewsGetHandler($eloquentNewsRepository, $eloquentNewsFactory)
        );
        $this->app->bind(
            NewsGetAllHandler::class,
            fn () => new NewsGetAllHandler($eloquentNewsRepository, $eloquentNewsFactory)
        );
        $this->app->bind(
            NewsCreateHandler::class,
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
