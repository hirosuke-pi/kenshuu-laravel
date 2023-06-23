<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Packages\Domains\Entities\User;

class Header extends Component
{
    public readonly ?User $user;
    public readonly bool $isGuestUser;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = null;
        $this->isGuestUser = is_null($this->user);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.header');
    }
}
