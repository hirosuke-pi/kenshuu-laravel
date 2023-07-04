<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

class NewsView extends Component
{
    public readonly News $news;
    public readonly array $paths;
    public readonly User $newsUser;
    public readonly bool $isAdmin;

    /**
     * ニュース概要画面を表示するコンポーネント
     *
     * @param News $news ニュースEntity
     * @param boolean $isAdmin 管理者かどうか
     * @param array $paths [['link' => 'https://example.com', 'name' => 'ホーム'], ...]
     * @return void
     */
    public function __construct(News $news, bool $isAdmin, array $paths)
    {
        $this->news = $news;
        $this->paths = $paths;
        $this->newsUser = $news->getUser();
        $this->isAdmin = $isAdmin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-view');
    }
}
