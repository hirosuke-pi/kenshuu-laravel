<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsSearch extends Component
{
    public readonly string $word;
    public  int $newsCount;

    /**
     *  ニュース検索コンポーネント
     *
     * @param string $word 検索ワード
     * @param int $newsCount 検索結果のニュース数
     */
    public function __construct(string $word = '', int $newsCount = 0)
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
