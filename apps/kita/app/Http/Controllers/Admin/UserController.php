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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // クエリパラメータを取得
        $last_name = $request->input('last_name');
        $first_name = $request->input('first_name');
        $email = $request->input('email');

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
        $admin_user = AdminUser::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 作成した管理者の編集画面にリダイレクト
        return redirect()->route('admin.admin_users.edit', $admin_user->id)->with('success', '登録処理が完了しました');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // 管理者ユーザーをIDで取得
        $admin_user = AdminUser::findOrFail($id);

        return view('admin.user.edit', compact('admin_user'));
    }

    /**
     * @param Request $request
     * @param AdminUser $admin_user
     * @return \Illuminate\Http\RedirectResponse
     */
    // データの更新
    public function update(Request $request, AdminUser $admin_user)
    {
        // バリデーションの適用
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('admin_users')->ignore($admin_user->id)->whereNull('deleted_at'),
            ],
        ]);

        // データ更新（変更した場合のみ）
        $admin_user->update(array_filter([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'] !== $admin_user->email ? $validated['email'] : null,
        ]));

        // フラッシュメッセージを追加し、同じ画面にリダイレクト
        return redirect()->route('admin.admin_users.edit', $admin_user->id)
            ->with('success', '更新処理が完了しました');
    }
}
