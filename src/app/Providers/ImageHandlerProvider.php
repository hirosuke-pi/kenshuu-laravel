<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Handlers\Tag\TagGetByIdsHandler;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;

class ImageHandlerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ImageRepositoryInterface::class,
            fn () => new EloquentImageRepository()
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
