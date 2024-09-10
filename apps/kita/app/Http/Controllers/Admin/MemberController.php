<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // クエリパラメータを取得
        $name = $request->input('name');
        $email = $request->input('email');

        // ページネーションの設定を取得
        $paginationLimit = config('pagination.members', 10);

        // クエリビルダーでフィルタリング
        $memberQuery = Member::query()
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%'.$name.'%');
            })
            ->when($email, function ($query, $email) {
                return $query->where('email', 'like', '%'.$email.'%');
            });

        // ページネーションの実行と検索クエリを保持
        $members = $memberQuery->orderBy('id')->paginate($paginationLimit)
            ->appends($request->all());

        // ビューに渡す
        return view('admin.member.index', compact('members'));
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

        // 特殊文字（% と _）をエスケープ
        return str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);
    }
}
