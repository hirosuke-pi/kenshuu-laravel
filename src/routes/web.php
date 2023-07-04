<?php

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
    Route::get('/news/{newsId}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::get('/news/{newsId}', [NewsController::class, 'view'])->name('news.view');

    Route::get('/user/{userId}', [UserController::class, 'index'])->name('user.index');
});

Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
