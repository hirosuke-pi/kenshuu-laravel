<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsSearch extends Component
{
    public string $word = '';
    public int $postsCount = 0;

    /**
     * Create a new component instance.
     */
    public function __construct(int $postsCount = 0)
    {
        $this->word = request()->input('word') ?? '';
        $this->postsCount = $postsCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.news-search');
    }
}
