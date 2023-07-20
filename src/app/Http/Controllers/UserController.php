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
     * @param Request $request リクエスト
     * @param UserGetByIdHandler $userGetById ユーザーIDからユーザーを取得するハンドラ
     * @param NewsGetByUserHandler $newsGetByUser ユーザーからニュースを取得するハンドラ
     * @return Factory | View | RedirectResponse
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
            status('error', 'ニュースが見つかりませんでした。');
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

    /**
     * ログイン画面を表示する
     *
     * @param Request $request リクエスト
     * @return Factory | View | RedirectResponse
     */
    public function loginView(Request $request): Factory | View | RedirectResponse {
        $loginUser = $request->input('loginUser')['entity'];
        if (!is_null($loginUser)) {
            status('error', 'ログインしているため、ログイン画面には遷移できません。');
            return redirect()->route('home');
        }

        return view('components.pages.login', [
            'loginUser' => null,
        ]);
    }

    /**
     * ユーザー登録画面を表示する
     *
     * @param Request $request リクエスト
     * @return Factory | View | RedirectResponse
     */
    public function registerView(Request $request): Factory | View | RedirectResponse {
        $loginUser = $request->input('loginUser')['entity'];
        if (!is_null($loginUser)) {
            status('error', 'ログインしているため、新規登録画面には遷移できません。');
            return redirect()->route('home');
        }

        return view('components.pages.register', [
            'loginUser' => null,
        ]);
    }
}
