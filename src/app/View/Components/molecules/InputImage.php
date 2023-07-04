<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Image;

class InputImage extends Component
{
    public readonly Image $image;
    public readonly string $imageId;
    public readonly string $buttonId;
    public readonly string $inputId;

    /**
     * Create a new component instance.
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
        $this->imageId = $image->getId();
        $this->buttonId = 'button-' . $image->getId();
        $this->inputId = 'input-' . $image->getId();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.input-image');
    }
}
