<?php

namespace App\View\Components\atoms;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Tag;

class CategoryCheckbox extends Component
{
    public readonly Tag $tag;
    public readonly string $checked;

    /**
     * Create a new component instance.
     */
    public function __construct(Tag $tag, bool $checked = false)
    {
        $this->tag = $tag;
        $this->checked = $checked ? 'checked' : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.category-checkbox');
    }
}
