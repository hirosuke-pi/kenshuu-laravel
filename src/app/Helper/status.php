<?php

if (!function_exists('status')) {
    function status(string $type, string $message): void
    {
        session()->flash(config('define.session.status'), ['type' => $type, 'message' => $message]);
    }
}
