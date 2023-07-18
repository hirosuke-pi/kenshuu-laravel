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

    /**
     * Create a new component instance.
     */
    public function __construct(?Image $image = null, string $defaultPrefix = '')
    {
        if ($image === null) {
            $this->imageUrl = News::getDefaultImageUrl();
            $this->imageId = $defaultPrefix;
            $this->buttonId = 'button-' . $defaultPrefix;
            $this->inputId = 'input-' . $defaultPrefix;
            return;
        }
        else {
            $this->imageUrl = $image->getUrl();
            $this->imageId = $image->getId();
            $this->buttonId = 'button-' . $image->getId();
            $this->inputId = 'input-' . $image->getId();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.input-image');
    }
}
