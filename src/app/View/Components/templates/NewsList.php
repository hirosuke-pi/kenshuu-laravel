<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Repo\NewsRepo;

class NewsList extends Component
{
    public readonly array $newsList;
    public readonly int $newsCount;

    /**
     * ニュースリストコンポーネント
     *
     * @param array $newsList ニュースリスト
     */
    public function __construct(array $newsList)
    {
        $this->newsList = $newsList;
        $this->newsCount = count($newsList);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-list');
    }
}
