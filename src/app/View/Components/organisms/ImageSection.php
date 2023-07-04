<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageSection extends Component
{
    public readonly array $images;
    public readonly bool $isEdit;

    /**
     * Create a new component instance.
     */
    public function __construct(array $images, bool $isEdit = false)
    {
        $this->images = $images;
        $this->isEdit = $isEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.image-section');
    }
}
