<?php

namespace App\View\Components\molecules;

use App\Repo\UserRepo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserHeader extends Component
{
    public UserRepo $user;

    /**
     * ユーザーヘッダーコンポーネント
     *
     * @param UserRepo $user ユーザーリポジトリ
     */
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.user-header');
    }
}
