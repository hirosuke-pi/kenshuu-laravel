<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Repo\NewsRepo;

class NewsList extends Component
{
    public array $posts = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->posts = NewsRepo::getAllNews();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-list');
    }
}
