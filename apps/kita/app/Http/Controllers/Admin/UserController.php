<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;

class UserController extends Controller
{
    public function index()
    {
        // 管理者データを10件ずつ取得し、ページネーションを設定
        $admin_users = AdminUser::paginate(10);

        return view('admin.user.index', compact('admin_users'));
    }
}
