<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\News\Interfaces\NewsGetByUserInterface;
use Packages\Applications\News\Requests\NewsGetByUserRequest;
use Packages\Applications\User\Interfaces\UserGetByIdInterface;
use Packages\Applications\User\Requests\UserGetByIdRequest;

class UserController extends Controller
{
    public function index(string $userId, UserGetByIdInterface $userGetById, NewsGetByUserInterface $newsGetByUser)
    {
        $userRequest = new UserGetByIdRequest($userId);
        $userResponse = $userGetById->handle($userRequest);

        if (!$userResponse->hasUser()) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ユーザーが見つかりませんでした。']);
            return redirect()->route('home');
        }
        $user = $userResponse->getUser();

        $newsRequest = new NewsGetByUserRequest($user);
        $newsResponse = $newsGetByUser->handle($newsRequest);

        return view('components.pages.user', [
            'user' => $user,
            'newsList' => $newsResponse->getNewsAll(),
        ]);
    }
}
