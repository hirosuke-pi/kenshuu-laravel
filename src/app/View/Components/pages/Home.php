<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\User;

class Home extends Component
{
    public readonly array $newsList;
    public readonly ?User $user;

    /**
     * Create a new component instance.
     */
    public function __construct(array $newsList, ?User $user)
    {
        $this->newsList = $newsList;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home');
    }
}
