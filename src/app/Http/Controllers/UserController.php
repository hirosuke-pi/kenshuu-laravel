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
    /**
     * ユーザー画面を表示する
     *
     * @param string $userId
     * @param UserGetByEmailInterface $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param UserGetByIdInterface $userGetById ユーザーIDからユーザーを取得するユースケース
     * @param NewsGetByUserInterface $newsGetByUser ユーザーからニュースを取得するユースケース
     * @return void
     */
    public function index(
        string $userId,
        Request $request,
        UserGetByIdInterface $userGetById,
        NewsGetByUserInterface $newsGetByUser
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $loginUser = $request->input('loginUser')['entity'];

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
            'isAdmin' => is_null($loginUser) ? false : $loginUser->validate($user),
            'newsList' => $newsResponse->getNewsAll(),
        ]);
    }

    public function login(UserGetByEmailInterface $userGetByEmail) {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);
        $loginUser = $userGetByEmailResponse->getUser();

        session()->push(config('session.user'), $loginUser->getId());

        return redirect()->route('home');
    }

    public function logout() {
        session()->forget(config('session.user'));

        return redirect()->route('home');
    }
}
