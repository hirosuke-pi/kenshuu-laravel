<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Image;
use Packages\Domains\Entities\News;

class InputImage extends Component
{
    public readonly string $imageUrl;
    public readonly string $imageId;
    public readonly string $buttonId;
    public readonly string $inputId;
    public readonly string $inputName;

    /**
     * Create a new component instance.
     */
    public function __construct(?Image $image = null, string $defaultPrefix = '', ?string $group = null)
    {
        $prefix = is_null($image) ? $defaultPrefix : $image->getId();
        $this->imageUrl = is_null($image) ? News::getDefaultImageUrl(): $image->getId();
        $this->imageId = $prefix;
        $this->buttonId = 'button-' . $prefix;
        $this->inputId = 'id-' . $prefix;
        $this->inputName = $group ?? 'input-' . $prefix;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.input-image');
    }
}
