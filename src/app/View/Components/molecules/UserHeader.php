<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\User;

class UserHeader extends Component
{
    public readonly User $user;
    public readonly string $userLink;

    /**
     * ユーザーヘッダーコンポーネント
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->userLink = route('user.index', ['userId' => $user->getId()]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.user-header');
    }
}
