<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt([...$credentials, ])) {
            $request->session()->regenerate();
            status('success', 'ログインしました。');
            return redirect()->route('home');
        }

        status('error', 'メールアドレスまたはパスワードが間違っています。');
        return redirect()->route('view.login');
    }

    public function logout() {
        Auth::logout();
        status('success', 'ログアウトしました。');
        return redirect()->route('home');
    }

    public function register(Request $request) {
        status('info', 'ユーザー登録処理を追加');
        return redirect()->route('home');
    }
}
