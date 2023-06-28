<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\News;

class NewsCard extends Component
{
    public readonly News $news;
    public readonly string $newsLink;
    public readonly string $cardSizeStyle;

    /**
     * カードのコンポーネントインスタンス
     *
     * @param News $news ニュースEntity
     */
    public function __construct(News $news, bool $isWide = false)
    {
        $this->news = $news;
        $this->cardSizeStyle = $isWide ? 'w-full' : 'w-96';
        $this->newsLink = route('news.view', ['newsId' => $news->getId()]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.news-card');
    }
}
