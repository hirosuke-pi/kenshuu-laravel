<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\View\Components\Pages\Home;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;
use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;

class HomeController extends Controller
{
    public static function index(NewsGetAllUseCase $newsGetAllUseCase, UserGetByEmailUseCase $userGetByEmailUseCase)
    {
        $newsGetAllRequest = new NewsGetAllRequest();
        $newsGetAllResponse = $newsGetAllUseCase->handle($newsGetAllRequest);

        $userGetByEmailRequest = new UserGetByEmailRequest(config('app.test.user1.email'));
        $userGetByEmailResponse = $userGetByEmailUseCase->handle($userGetByEmailRequest);

        return (new Home(
            newsList: $newsGetAllResponse->getNewsAll(),
            user: $userGetByEmailResponse->getUser()
        ))->render();
    }
}
