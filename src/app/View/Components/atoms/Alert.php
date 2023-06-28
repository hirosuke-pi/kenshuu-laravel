<?php

namespace App\View\Components\atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Enums\AlertType;

class Alert extends Component
{
    public string $title;
    public string $message;
    public string $baseColor;
    public string $icon;
    public bool $visibleCloseButton;
    public string $padding;

    /**
     * アラートコンポーネント
     *
     * @param string $title タイトル
     * @param string $message メッセージ
     * @param int $type アラートタイプ (AlertType)
     * @param bool $visibleCloseButton 閉じるボタンを表示するかどうか
     */
    public function __construct(string $title, string $message, int $type, bool $visibleCloseButton = true)
    {
        $this->title = $title;
        $this->message = $message;
        $this->baseColor = match($type) {
            AlertType::ERROR => 'red',
            AlertType::SUCCESS => 'green',
            AlertType::INFO => 'blue',
            AlertType::WARNING => 'yellow',
        };
        $this->icon = match($type) {
            AlertType::ERROR => 'fa-circle-exclamation',
            AlertType::SUCCESS => 'fa-circle-check',
            AlertType::INFO => 'fa-circle-info',
            AlertType::WARNING => 'fa-triangle-exclamation',
        };
        $this->visibleCloseButton = $visibleCloseButton;
        $this->padding = $visibleCloseButton ? 'pl-4 pr-10' : 'px-4';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.alert');
    }
}
