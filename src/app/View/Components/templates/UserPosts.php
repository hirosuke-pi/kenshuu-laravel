<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\User;

class UserPosts extends Component
{
    public readonly array $newsList;
    public readonly array $paths;

    /**
     * ユーザーの投稿一覧を表示するコンポーネント
     *
     * @param User $user ユーザーEntity
     * @param array $newsList ニュースリスト
     */
    public function __construct(User $user, array $newsList)
    {
        $this->newsList = $newsList;
        $this->paths = [
            ['link' => '#', 'name' => 'ユーザー - ' . $user->getNameTag()],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.user-posts');
    }
}
