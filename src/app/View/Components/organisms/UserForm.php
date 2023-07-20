<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserForm extends Component
{
    public readonly array $paths;
    public readonly string $registerLink;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->paths = [
            ['name' => '新規登録', 'link' => '#']
        ];
        $this->registerLink = route('auth.register');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.user-form');
    }
}
