<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Enums\AlertType;

class AlertStatus extends Component
{
    public int $type = AlertType::INFO;
    public string $title = '';
    public ?string $message;

    /**
     * statusの内容を元に、アラートを表示するコンポーネント
     *
     * @param array $status ['type' => 'success|error|warning', 'message' => 'メッセージ']
     */
    public function __construct(array $status = [])
    {
        $type = $status['type'] ?? null;
        $this->title = match($type) {
            'success' => '成功',
            'error' => 'エラー',
            'warning' => '警告',
            default => '',
        };
        $this->type = match($type) {
            'success' => AlertType::SUCCESS,
            'error' => AlertType::ERROR,
            'warning' => AlertType::WARNING,
            default => AlertType::INFO,
        };
        $this->message = $status['message'] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (is_null($this->message)) {
            return '';
        }
        return view('components.molecules.alert-status');
    }
}
