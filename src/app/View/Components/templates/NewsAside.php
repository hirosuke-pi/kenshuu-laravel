<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

class NewsAside extends Component
{
    public readonly News $news;
    public readonly User $newsUser;
    public readonly string $newsUserLink;
    public readonly bool $isAdmin;
    public readonly string $title;
    public readonly bool $isEditorMode;

    /**
     * ニュース詳細画面を表示するコンポーネント
     *
     * @param News $news ニュースEntity
     * @param boolean $isAdmin 管理者かどうか
     * @param string $title タイトル
     */
    public function __construct(News $news, bool $isAdmin, string $title, bool $isEditorMode)
    {
        $this->news = $news;
        $this->newsUser = $news->getUser();
        $this->newsUserLink = route('user.index', ['userId' => $this->newsUser->getId()]);
        $this->isAdmin = $isAdmin;
        $this->title = $title;
        $this->isEditorMode = $isEditorMode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-aside');
    }
}
