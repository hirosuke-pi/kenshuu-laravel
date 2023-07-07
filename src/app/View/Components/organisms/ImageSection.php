<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Image;

class ImageSection extends Component
{
    public readonly array $images;
    public readonly bool $isEdit;

    /**
     * 画像を表示するコンポーネント
     *
     * @param array $images 画像の配列
     * @param boolean $isEdit 編集モードかどうか
     */
    public function __construct(array $images, bool $isEdit = false)
    {
        if ($isEdit) {
            $inputImage = $images;
            $maxImageCount = config('define.max_image_count', 5);
            for($i = count($images); $i < $maxImageCount; $i++) {
                $inputImage[] = new Image('image-new-' . $i, false, '');
            }
            $this->$images = $inputImage;
        }
        else {
            $this->images = $images;
        }
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
