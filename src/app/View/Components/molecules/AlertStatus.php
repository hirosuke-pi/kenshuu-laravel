<?php

namespace App\View\Components\molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\View\Components\atoms\AlertType;

class AlertStatus extends Component
{
    public AlertType $type = AlertType::INFO;
    public string $title = '';
    public string $message = '';
    public bool $visible = false;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $status = session(config('define.session.status'), null);
        if (is_null($status)) {
            return;
        }

        $this->type = match($status['type']) {
            'success' => '成功',
            'error' => 'エラー',
            'info' => '',
            'warning' => '警告',
        };
        $this->title = match($status['type']) {
            'success' => AlertType::SUCCESS,
            'error' => AlertType::ERROR,
            'info' => AlertType::INFO,
            'warning' => AlertType::WARNING,
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
