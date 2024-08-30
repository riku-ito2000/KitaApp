<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Member\Auth\LoginController;
use Illuminate\Http\Request;

class AdminLoginController extends LoginController
{
protected $redirectTo = '/admin/admin_users';

public function __construct()
{
parent::__construct();  // 親クラスのコンストラクタを呼び出す

$this->middleware('guest:admin')->except('logout');
}

protected function guard()
{
return auth()->guard('admin_users');
}

public function showLoginForm()
{
return view('admin.auth.login'); // 管理者用のログインフォームを表示
}

public function logout(Request $request)
{
$this->guard()->logout();

$request->session()->invalidate();

$request->session()->regenerateToken();

return redirect('/admin/login');
}
}
