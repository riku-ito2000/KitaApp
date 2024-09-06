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
        $lastName = $this->escapeLike($request->input('last_name'));
        $firstName = $this->escapeLike($request->input('first_name'));
        $email = $this->escapeLike($request->input('email'));

        // ページネーションの設定を取得
        $paginationLimit = config('pagination.admin_users', 10);

        // クエリビルダーでフィルタリング
        $adminUsers = AdminUser::query();

        if ($lastName) {
            $adminUsers->where('last_name', 'like', '%'.$lastName.'%');
        }

        if ($firstName) {
            $adminUsers->where('first_name', 'like', '%'.$firstName.'%');
        }

        if ($email) {
            $adminUsers->where('email', 'like', '%'.$email.'%');
        }

        // ID順に並べる
        $adminUsers->orderBy('id');

        // ページネーションの実行と検索クエリを保持
        $adminUsers = $adminUsers->paginate($paginationLimit)
            ->appends($request->except('page'));

        // メッセージを設定
        $message = $adminUsers->isEmpty() ? '管理者が見つかりませんでした。' : null;

        return view('admin.user.index', compact('adminUsers', 'message'));
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
