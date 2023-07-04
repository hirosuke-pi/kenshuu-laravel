<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Packages\Applications\User\Handlers\UserGetByIdHandler;
use Packages\Applications\User\Requests\UserGetByIdRequest;
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
        $userGetByEmail = new UserGetByIdHandler($eloquentUserRepository);
        $userId = session(config('session.user'), '')[0] ?? '';
        $userGetByEmailRequest = new UserGetByIdRequest($userId);

        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);

        $loginUser = $userGetByEmailResponse->getUser();
        $request->merge([config('session.user') => ['entity' => $loginUser]]);

        return $next($request);
    }
}
