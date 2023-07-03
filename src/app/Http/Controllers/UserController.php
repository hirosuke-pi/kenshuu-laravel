<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\News\Interfaces\NewsGetByUserInterface;
use Packages\Applications\News\Requests\NewsGetByUserRequest;
use Packages\Applications\User\Interfaces\UserGetByEmailInterface;
use Packages\Applications\User\Interfaces\UserGetByIdInterface;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Requests\UserGetByIdRequest;

class UserController extends Controller
{
    public function index(
        string $userId,
        UserGetByEmailInterface $userGetByEmail,
        UserGetByIdInterface $userGetById,
        NewsGetByUserInterface $newsGetByUser
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);
        $loginUser = $userGetByEmailResponse->getUser();

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
            'loginUser' => $loginUser,
            'isAdmin' => $userGetByEmailResponse->hasUser() ? $loginUser->validate($user) : false,
            'newsList' => $newsResponse->getNewsAll(),
        ]);
    }
}
