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
    public readonly User $author;
    public readonly string $authorLink;
    public readonly bool $isAdmin;
    public readonly string $title;
    public readonly bool $isEditorMode;
    public readonly bool $isNewCreate;
    public readonly array $tags;
    public readonly array $images;

    /**
     * ニュース詳細画面を表示するコンポーネント
     *
     * @param News|null $news ニュースEntity
     * @param boolean $isAdmin 管理者かどうか
     * @param string $title タイトル
     * @param boolean $isEditorMode 編集モードかどうか
     * @param boolean $isNewCreate 新規作成モードかどうか
     * @param User $author 作成者
     */
    public function __construct(
        ?News $news,
        bool $isAdmin,
        string $title,
        bool $isEditorMode,
        bool $isNewCreate,
        User $author
    )
    {
        $this->news = $news;
        $this->author = $author;
        $this->authorLink = route('user.index', ['userId' => $this->author->getId()]);
        $this->isAdmin = $isAdmin;
        $this->title = $title;
        $this->isEditorMode = $isEditorMode;
        $this->isNewCreate = $isNewCreate;

        if ($isNewCreate) {
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
