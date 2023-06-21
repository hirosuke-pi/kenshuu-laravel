<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Domains\UseCases\NewsGetUseCase;
use App\Infrastructure\Repositories\EloquentNewsRepository;


class NewsList extends Component
{
    public array $posts = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $repository = new EloquentNewsRepository();
        $news = new NewsGetUseCase($repository);
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
