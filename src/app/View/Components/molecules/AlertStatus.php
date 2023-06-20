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
    public string $message = '';
    public bool $visible = false;

    /**
     * セッション内に config('define.session.status') が存在する場合、
     * アラートを表示するコンポーネント
     */
    public function __construct()
    {
        $status = session(config('define.session.status'), null);
        if (is_null($status)) {
            return;
        }

        $this->title = match($status['type']) {
            'success' => '成功',
            'error' => 'エラー',
            'warning' => '警告',
            default => '',
        };
        $this->type = match($status['type']) {
            'success' => AlertType::SUCCESS,
            'error' => AlertType::ERROR,
            'warning' => AlertType::WARNING,
            default => AlertType::INFO,
        };
        $this->message = $status['message'];
        $this->visible = true;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!$this->visible) {
            return '';
        }
        return view('components.molecules.alert-status');
    }
}
