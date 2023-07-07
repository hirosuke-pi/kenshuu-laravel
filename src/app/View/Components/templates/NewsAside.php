<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

class NewsAside extends Component
{
    public readonly ?News $news;
    public readonly User $newsUser;
    public readonly string $newsUserLink;
    public readonly bool $isAdmin;
    public readonly string $title;
    public readonly bool $isEditorMode;
    public readonly bool $isNewMode;
    public readonly array $tags;
    public readonly array $images;

    /**
     * ニュース詳細画面を表示するコンポーネント
     *
     * @param News|null $news ニュースEntity
     * @param boolean $isAdmin 管理者かどうか
     * @param string $title タイトル
     * @param boolean $isEditorMode 編集モードかどうか
     * @param boolean $isNewMode 新規作成モードかどうか
     * @param User|null $creator 作成者
     */
    public function __construct(
        ?News $news,
        bool $isAdmin,
        string $title,
        bool $isEditorMode,
        bool $isNewMode,
        User $creator = null
    )
    {
        $this->news = $news;
        $this->newsUser = $creator ?? $news->getUser();
        $this->newsUserLink = route('user.index', ['userId' => $this->newsUser->getId()]);
        $this->isAdmin = $isAdmin;
        $this->title = $title;
        $this->isEditorMode = $isEditorMode;
        $this->isNewMode = $isNewMode;

        if ($isNewMode) {
            $this->tags = [];
            $this->images = [];
        } else {
            $this->tags = $news->getTags();
            $this->images = $news->getImages();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-aside');
    }
}
