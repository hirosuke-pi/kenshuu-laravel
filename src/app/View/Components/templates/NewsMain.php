<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

class NewsMain extends Component
{
    public readonly ?News $news;
    public readonly array $paths;
    public readonly User $newsUser;
    public readonly bool $isAdmin;
    public readonly bool $isEditorMode;

    /**
     * ニュース概要画面を表示するコンポーネント
     *
     * @param News|null $news ニュースEntity
     * @param boolean $isAdmin 管理者かどうか
     * @param array $paths [['link' => 'https://example.com', 'name' => 'ホーム'], ...]
     * @param boolean $isEditorMode 編集モードかどうか
     * @param User|null $creator 作成者
     * @return void
     */
    public function __construct(?News $news, bool $isAdmin, array $paths, bool $isEditorMode, $creator = null)
    {
        $this->news = $news;
        $this->paths = $paths;
        $this->newsUser = $creator ?? $news->getUser();
        $this->isAdmin = $isAdmin;
        $this->isEditorMode = $isEditorMode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.news-main');
    }
}
