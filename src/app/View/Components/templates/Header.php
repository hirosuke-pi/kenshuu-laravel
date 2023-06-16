<?php

namespace App\View\Components\templates;

use App\Repo\UserRepo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public ?UserRepo $user;
    /**
     * Create a new component instance.
     */
    public function __construct(string $user = null)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.header');
    }
}
