<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * ホームページ
 */

Route::group(['middleware' => ['login.user']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/news/edit/{newsId}', [NewsController::class, 'edit'])->name('news.edit');
    Route::get('/news/view/{newsId}', [NewsController::class, 'view'])->name('news.view');

    Route::get('/user/{userId}', [UserController::class, 'index'])->name('user.index');

    Route::group(['middleware' => ['require.login']], function() {
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    });
});

Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/register', [AuthController::class, 'register'])->name('auth.register');
