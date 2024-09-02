<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Member\ArticleController;
use App\Http\Controllers\Member\Auth\LoginController;
use App\Http\Controllers\Member\Auth\RegisterController;
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
        Route::resource('articles', ArticleController::class)->except(['index', 'show']);
    });

    // プロフィール編集ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // パスワード変更ルート
    Route::get('/password_change', [ProfileController::class, 'showPasswordChangeForm'])->name('password.change.form');
    Route::put('/password_change', [ProfileController::class, 'passwordChange'])->name('password.change');
});

//管理者ログイン
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
        Route::get('admin_users', [UserController::class, 'index'])->name('admin_users.index');
    });

});
//テスト用　新規追加実装後消去
Route::get('/test-hashing', [AdminLoginController::class, 'testHashing']);
