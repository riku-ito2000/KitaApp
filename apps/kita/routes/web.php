<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// 既存の登録ルートをコメントアウト
// Auth::routes();

// 新しい登録ルートを定義
Route::middleware('guest')->group(function () {
    // 会員登録ルート
    Route::get('member_registration', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('member_registration', [RegisterController::class, 'register']);

    // ログインルート
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// ログアウトルート
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// 認証が必要なルート
//Route::middleware('auth')->group(function () {
//    Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
//});

//一覧画面に遷移するルート
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
