<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\News;

class NewsView extends Component
{
    public readonly News $news;
    public readonly array $paths;

    /**
     * ニュース概要画面を表示するコンポーネント
     *
     * @param array $paths [['link' => 'https://example.com', 'name' => 'ホーム'], ...]
     * @return void
     */
    public function __construct(News $news, array $paths)
    {
        $this->news = $news;
        $this->paths = $paths;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-view');
    }
}
