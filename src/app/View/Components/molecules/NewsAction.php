<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\News;

class NewsAction extends Component
{
    public readonly string $newsEditUrl;
    public readonly string $newsDeleteUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(News $news)
    {
        $this->newsEditUrl = route('news.edit', ['newsId' => $news->getId()]);
        $this->newsDeleteUrl = route('news.delete', ['newsId' => $news->getId()]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.news-action');
    }
}
