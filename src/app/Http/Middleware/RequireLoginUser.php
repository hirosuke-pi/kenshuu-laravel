<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireLoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset($request->input(config('session.user'))['entity'])) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ログインしてください。']);
            return redirect()->route('home');
        }

        return $next($request);
    }
}
