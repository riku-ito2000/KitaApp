<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 入力データのバリデーション
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 新しい管理者を作成
        $adminUser = AdminUser::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 作成した管理者の編集画面にリダイレクト
        return redirect()->route('admin.admin_users.edit', $adminUser->id)->with('success', '登録処理が完了しました');
    }

    /**
     * Displaying admin user edit
     *
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.user.edit', compact('adminUser'));
    }

    /**
     * Updating user information
     *
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        // バリデーションの適用
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('admin_users')->ignore($adminUser->id)->whereNull('deleted_at'),
            ],
        ]);

        // データ更新
        $adminUser->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        // フラッシュメッセージを追加し、同じ画面にリダイレクト
        return redirect()->route('admin.admin_users.edit', $adminUser->id)
            ->with('success', '更新処理が完了しました');
    }
}
