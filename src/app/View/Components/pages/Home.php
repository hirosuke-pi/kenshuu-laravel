<?php

namespace App\View\Components\pages;

use App\Repo\NewsRepo;
use App\Repo\UserRepo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Home extends Component
{
    public string $user;
    public string $test;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = 'aaaa';
        $this->test = 'aaaa';
        /*
        if (true) {

            echo 'aaaa';
            return;
        }
        $this->user = new UserRepo(0);
        */
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home');
    }
}
