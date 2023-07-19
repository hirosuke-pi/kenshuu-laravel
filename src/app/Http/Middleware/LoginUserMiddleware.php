<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Packages\Handlers\User\UserGetByIdHandler;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Symfony\Component\HttpFoundation\Response;

class LoginUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eloquentUserRepository = new EloquentUserRepository();
        $userGetById = new UserGetByIdHandler($eloquentUserRepository);

        $loginUser = $loginUser = Auth::check() ? $userGetById->handle(Auth::id()) : null;
        $request->merge([config('session.user') => ['entity' => $loginUser]]);

        return $next($request);
    }
}
