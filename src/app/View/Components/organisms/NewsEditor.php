<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\News;

class NewsEditor extends Component
{
    public readonly News $news;

    /**
     * Create a new component instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.news-editor');
    }
}
