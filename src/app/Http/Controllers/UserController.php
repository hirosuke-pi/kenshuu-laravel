<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Packages\Handlers\News\NewsGetByUserHandler;
use Packages\Handlers\User\UserGetByEmailHandler;
use Packages\Handlers\User\UserGetByIdHandler;



class UserController extends Controller
{
    /**
     * ユーザー画面を表示する
     *
     * @param string $userId
     * @param UserGetByEmailHandler $userGetByEmail メールアドレスからユーザーを取得するハンドラ
     * @param UserGetByIdHandler $userGetById ユーザーIDからユーザーを取得するハンドラ
     * @param NewsGetByUserHandler $newsGetByUser ユーザーからニュースを取得するハンドラ
     * @return void
     */
    public function index(
        string $userId,
        Request $request,
        UserGetByIdHandler $userGetById,
        NewsGetByUserHandler $newsGetByUser
    ): Factory | View | RedirectResponse
    {
        $loginUser = $request->input('loginUser')['entity'];

        $user = $userGetById->handle($userId);
        if (is_null($user)) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ユーザーが見つかりませんでした。']);
            return redirect()->route('home');
        }

        $newsEntities = $newsGetByUser->handle($user);

        return view('components.pages.user', [
            'user' => $user,
            'loginUser' => $loginUser,
            'isAdmin' => is_null($loginUser) ? false : $loginUser->validate($user),
            'newsList' => $newsEntities,
        ]);
    }

    public function login(UserGetByEmailHandler $userGetByEmail) {
        $loginUser = $userGetByEmail->handle(config('test.user1.email'));
        session()->push(config('session.user'), $loginUser->getId());

        return redirect()->route('home');
    }

    public function logout() {
        session()->forget(config('session.user'));

        return redirect()->route('home');
    }
}
