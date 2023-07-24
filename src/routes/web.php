<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsFormController;
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
    Route::get('/news/view/{newsId}', [NewsController::class, 'view'])->name('news.view');

    Route::get('/user/{userId}', [UserController::class, 'index'])->name('user.index');

    Route::get('/login', [UserController::class, 'login'])->name('view.login');
    Route::get('/register', [UserController::class, 'register'])->name('view.register');

    Route::group(['middleware' => ['require.login']], function() {
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news/create', [NewsFormController::class, 'post']);
    });
    Route::group(['middleware' => ['require.author']], function() {
        Route::get('/news/edit/{newsId}', [NewsController::class, 'edit'])->name('news.edit');

        Route::post('/news/edit/{newsId}', [NewsFormController::class, 'edit']);
        Route::post('/news/delete/{newsId}', [NewsFormController::class, 'delete'])->name('news.delete');
    });
});

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/register', [AuthController::class, 'registerAndLogin'])->name('auth.register');
