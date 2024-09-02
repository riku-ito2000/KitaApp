<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/admin_users';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login'); // 管理者用のログインフォームを表示
    }

    public function login(Request $request)
    {
        // 会員ログインセッションが存在する場合、それを破棄
        auth()->guard('web')->logout();

        // バリデーション
        $this->validateLogin($request);

        // 認証を試みる
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // 認証失敗時の処理
        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return auth()->guard('admin')->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }
}
