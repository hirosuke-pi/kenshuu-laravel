<?php

namespace App\View\Components\templates;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Domains\UseCases\NewsGetUseCase;
use App\Infrastructure\Repositories\EloquentNewsRepository;
use App\Infrastructure\Repositories\EloquentImageRepository;
use App\Infrastructure\Repositories\EloquentTagRepository;
use App\Infrastructure\Repositories\InMemoryUserRepository;


class NewsList extends Component
{
    public array $posts = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $newsRepository = new EloquentNewsRepository();
        $news = new NewsGetUseCase($newsRepository);

        $this->posts = $news->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-list');
    }
}
