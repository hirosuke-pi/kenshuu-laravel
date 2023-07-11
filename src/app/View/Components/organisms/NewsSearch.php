<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsSearch extends Component
{
    public string $word = '';
    public int $newsCount = 0;

    /**
     * ニュース検索コンポーネント
     */
    public function __construct(string $word, int $newsCount)
    {
        $this->word = $word;
        $this->newsCount = $newsCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.news-search');
    }
}
