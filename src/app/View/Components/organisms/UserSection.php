<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\User;

class UserSection extends Component
{
    public readonly string $title;
    public readonly User $user;
    public readonly bool $isAdmin;
    public readonly string $userLink;

    /**
     * ユーザー情報を表示するコンポーネント
     *
     * @param string $title タイトル
     * @param User $user ユーザーEntity
     * @param boolean $isAdmin 管理者かどうか
     */
    public function __construct(string $title, User $user, bool $isAdmin)
    {
        $this->title = $title;
        $this->user = $user;
        $this->isAdmin = $isAdmin;
        $this->userLink = route('user.index', ['userId' => $this->user->getId()]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.user-section');
    }
}
