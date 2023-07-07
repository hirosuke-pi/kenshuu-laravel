<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\User;

class UserAside extends Component
{
    public readonly User $user;
    public readonly bool $isAdmin;

    /**
     * ユーザー詳細画面を表示する全体コンポーネント
     *
     * @param User $user ユーザーEntity
     * @param boolean $isAdmin 管理者かどうか
     */
    public function __construct(User $user, bool $isAdmin)
    {
        $this->user = $user;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.user-aside');
    }
}
