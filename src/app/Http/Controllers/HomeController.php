<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

class HomeController extends Controller
{
    public static function index(UserGetByEmailUseCase $userGetByEmailUseCase)
    {
        $userGetByEmailRequest = new UserGetByEmailRequest('test@gmail.com');
        $userGetByEmailResponse = $userGetByEmailUseCase->handle($userGetByEmailRequest);

        return view('components.pages.home', [
            'user' => $userGetByEmailResponse->getUser()
        ]);
    }
}
