<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Handlers\User\UserGetByEmailHandler;

class AuthController extends Controller
{
    public function login(UserGetByEmailHandler $userGetByEmail) {
        $loginUser = $userGetByEmail->handle(config('test.user1.email'));
        status('success', 'ログインしました。');
        session()->push(config('session.user'), $loginUser->getId());

        return redirect()->route('home');
    }

    public function logout() {
        session()->forget(config('session.user'));
        status('success', 'ログアウトしました。');

        return redirect()->route('home');
    }

    public function register(Request $request) {
        status('info', 'ユーザー登録処理を追加');
        return redirect()->route('home');
    }
}
