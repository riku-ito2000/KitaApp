<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Displaying the admin member list and searching the admins
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // クエリパラメータを取得
        $last_name = $this->escapeLike($request->input('last_name'));
        $first_name = $this->escapeLike($request->input('first_name'));
        $email = $this->escapeLike($request->input('email'));

        // ページネーションの設定を取得
        $paginationLimit = config('pagination.admin_users', 10);

        // クエリビルダーでフィルタリング
        $admin_users = AdminUser::query();

        if ($last_name) {
            $admin_users->where('last_name', 'like', '%'.$last_name.'%');
        }

        if ($first_name) {
            $admin_users->where('first_name', 'like', '%'.$first_name.'%');
        }

        if ($email) {
            $admin_users->where('email', 'like', '%'.$email.'%');
        }

        // ページネーションの実行と検索クエリを保持
        $admin_users = $admin_users->paginate($paginationLimit)
            ->appends($request->except('page'));

        // メッセージを設定
        $message = $admin_users->isEmpty() ? '管理者が見つかりませんでした。' : null;

        return view('admin.user.index', compact('admin_users', 'message'));
    }

    /**
     * LIKEクエリ用に特殊文字をエスケープ
     *
     * @param string|null $value
     * @return string
     */
    private function escapeLike(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);
    }
}
