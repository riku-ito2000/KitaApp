<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // クエリパラメータを取得
        $name = $request->input('tag_name');

        // ページネーションの設定を取得
        $paginationLimit = config('pagination.tags', 10);

        // クエリビルダーでフィルタリング
        $tagQuery = ArticleTag::query()
            ->when($name, function ($query, $name) {
                // escapeLikeメソッドを使ってLIKEクエリをエスケープ
                return $query->where('name', 'like', '%'.$this->escapeLike($name).'%');
            });

        // ページネーションの実行と検索クエリを保持
        $tags = $tagQuery->orderBy('id')->paginate($paginationLimit)
            ->appends($request->all());

        // ビューに渡す
        return view('admin.tag.index', compact('tags'));
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

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag_name' => 'required|string|max:255|unique:article_tags,name',
        ]);

        // 新しいタグを作成
        $articleTag = ArticleTag::create([
            'name' => $validated['tag_name'],
        ]);

        return redirect()->route('admin.article_tags.edit', $articleTag->id)->with('success', '登録処理が完了しました');
    }


    public function edit(ArticleTag $articleTag)
    {
        return view('admin.tag.edit', compact('articleTag'));
    }
}
