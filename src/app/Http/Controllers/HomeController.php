<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailUseCase $userGetByEmailUseCase メールアドレスからユーザーを取得するユースケース
     * @return \Illuminate\View\View ホーム画面のView
     */
    public static function index(UserGetByEmailUseCase $userGetByEmailUseCase): \Illuminate\View\View
    {
        $userGetByEmailRequest = new UserGetByEmailRequest('test@gmail.com');
        $userGetByEmailResponse = $userGetByEmailUseCase->handle($userGetByEmailRequest);

        return view('components.pages.home', [
            'user' => $userGetByEmailResponse->getUser()
        ]);
    }
}
