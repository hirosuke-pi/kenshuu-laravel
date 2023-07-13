<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcrumbSection extends Component
{
    public readonly array $paths;

    /**
     * Create a new component instance.
     */
    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.breadcrumb-section');
    }
}
