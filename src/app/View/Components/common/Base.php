<?php

namespace App\View\Components\common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Base extends Component
{
    public string $title;

    /**
     * <body>までのHTMLを生成するコンポーネント
     *
     * @param string $title タイトル
     */
    public function __construct(string $title = null)
    {
        if (is_null($title)) {
            $this->title = '';
            return;
        }
        $this->title = ' - '. $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.base');
    }
}
