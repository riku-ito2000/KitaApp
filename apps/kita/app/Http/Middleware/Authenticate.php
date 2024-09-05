<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // 管理者用のリクエストかどうかを判断
            if ($request->is('admin/*')) {
                return route('admin.login'); // 管理者ログインページにリダイレクト
            }

            return route('login'); // 会員ログインページにリダイレクト
        }

        return '';
    }
}
