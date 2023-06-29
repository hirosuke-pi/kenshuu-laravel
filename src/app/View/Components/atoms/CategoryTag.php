<?php

namespace App\View\Components\atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryTag extends Component
{
    public readonly string $name;

    /**
     * カテゴリータグコンポーネント
     *
     * @param string $name カテゴリー名
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.category-tag');
    }
}
