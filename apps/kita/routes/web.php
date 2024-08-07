<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

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
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
});

//記事検索ルート
Route::get('/search', [ArticleController::class, 'search'])->name('search');
