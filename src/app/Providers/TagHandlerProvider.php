<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Handlers\Tag\TagGetByIdsHandler;
use Packages\Infrastructure\Repositories\EloquentTagRepository;

class TagHandlerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $tagRepository = new EloquentTagRepository();

        $this->app->bind(
            TagGetByIdsHandler::class,
            fn () => new TagGetByIdsHandler($tagRepository)
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
