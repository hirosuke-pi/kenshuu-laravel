<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Applications\Tag\Handlers\TagGetByIdsHandler;
use Packages\Applications\Tag\UseCases\TagGetByIdsUseCase;
use Packages\Infrastructure\Repositories\EloquentTagRepository;

class TagUseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $tagRepository = new EloquentTagRepository();

        $this->app->bind(
            TagGetByIdsUseCase::class,
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
