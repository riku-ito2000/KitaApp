<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 認証が不要なルート
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('member_registration', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('member_registration', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // 記事作成・編集ルート
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');

    // プロフィール編集ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // パスワード変更ルート
    Route::get('/password_change', [ProfileController::class, 'showPasswordChangeForm'])->name('password.change.form');
    Route::put('/password_change', [ProfileController::class, 'passwordChange'])->name('password.change');
});

// 認証不要なルート
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/search', [ArticleController::class, 'search'])->name('search');
