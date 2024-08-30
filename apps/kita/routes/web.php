<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ホームページ（ログインフォーム）ルート
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// 認証が不要なルート
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

// 認証が不要なルート
Route::get('/articles', [ArticleController::class, 'index'])->name('member.articles.index');

Route::middleware('auth')->group(function () {

    // 記事作成、編集、更新、削除ルート（member prefixを使用）
    Route::prefix('member')->name('member.')->group(function () {
        Route::resource('articles', ArticleController::class)->except(['index']);
    });

    // プロフィール編集ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // パスワード変更ルート
    Route::get('/password_change', [ProfileController::class, 'showPasswordChangeForm'])->name('password.change.form');
    Route::put('/password_change', [ProfileController::class, 'passwordChange'])->name('password.change');
});
