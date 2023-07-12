<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\User;

class Header extends Component
{
    public readonly ?User $loginUser;
    public readonly bool $isLoginUser;

    /**
     * ヘッダーコンポーネント
     *
     * @param User|null $user ユーザーEntity
     */
    public function __construct(?User $loginUser)
    {
        $this->loginUser = $loginUser;
        $this->isLoginUser = !is_null($loginUser);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.header');
    }
}
