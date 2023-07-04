<?php

namespace App\View\Components\atoms;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Tag;

class CategoryCheckbox extends Component
{
    public readonly Tag $tag;

    /**
     * Create a new component instance.
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.category-checkbox');
    }
}
