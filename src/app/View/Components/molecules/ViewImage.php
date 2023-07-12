<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Image;

class ViewImage extends Component
{
    public readonly Image $image;

    /**
     * Create a new component instance.
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.view-image');
    }
}
