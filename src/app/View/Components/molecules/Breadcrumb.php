<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $paths;

    /**
     * 現在いる階層を表示するコンポーネント
     *
     * @param array $paths [['link' => 'https://example.com', 'name' => 'ホーム'], ...]
     * @return void
     */
    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.breadcrumb');
    }
}
