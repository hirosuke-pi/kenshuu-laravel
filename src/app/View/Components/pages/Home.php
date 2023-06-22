<?php

namespace App\View\Components\Pages;

use App\UseCases\NewsGetUseCase;
use App\Infrastructure\Factories\EloquentNewsFactory;
use App\Infrastructure\Repositories\EloquentImageRepository;
use App\Infrastructure\Repositories\EloquentNewsRepository;
use App\Infrastructure\Repositories\EloquentTagRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Home extends Component
{
    public readonly array $newsEntities;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $newsFactory = new EloquentNewsFactory(
            new EloquentUserRepository(),
            new EloquentTagRepository(),
            new EloquentImageRepository(),
        );
        $newsRepository = new EloquentNewsRepository($newsFactory);

        $news = new NewsGetUseCase($newsRepository);
        $this->newsEntities = $news->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home');
    }
}
