<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginForm extends Component
{
    public readonly array $paths;
    public readonly string $loginLink;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->paths = [
            ['name' => 'ログイン', 'link' => '#']
        ];
        $this->loginLink = route('auth.login');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.login-form');
    }
}
