<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagSection extends Component
{
    public readonly array $tags;
    public readonly bool $isCheckbox;

    /**
     * Create a new component instance.
     */
    public function __construct(array $tags, bool $isCheckbox = false)
    {
        $this->tags = $tags;
        $this->isCheckbox = $isCheckbox;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.tag-section');
    }
}
