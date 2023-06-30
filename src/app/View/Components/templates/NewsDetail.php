<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

class NewsDetail extends Component
{
    public readonly News $news;
    public readonly User $newsUser;
    public readonly User $user;
    public readonly bool $isGuest;
    public readonly string $title;

    /**
     * ニュース詳細画面を表示するコンポーネント
     *
     * @param News $news
     */
    public function __construct(News $news, User $user, bool $isGuest, string $title)
    {
        $this->news = $news;
        $this->newsUser = $news->getUser();
        $this->user = $user;
        $this->isGuest = $isGuest;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-detail');
    }
}
