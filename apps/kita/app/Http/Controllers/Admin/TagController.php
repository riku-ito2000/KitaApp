<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param ArticleTag $articleTag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ArticleTag $articleTag)
    {
        return view('admin.tag.edit', compact('articleTag'));
    }

    /**
     * @param Request $request
     * @param Article $articleTag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ArticleTag $articleTag)
    {
        // バリデーションの適用
        $validated = $request->validate([
            'tag_name' => 'required|string|max:255|unique:article_tags,name',
        ]);

        // データ更新
        $articleTag->update([
            'name' => $validated['tag_name'],
        ]);

        // フラッシュメッセージを追加し、同じ画面にリダイレクト
        return redirect()->route('admin.article_tags.edit', $articleTag->id)
            ->with('success', '更新処理が完了しました');
    }

    public function destroy(ArticleTag $articleTag)
    {
        // 物理削除を実行
        $articleTag->delete();

        // フラッシュメッセージを追加し、タグ一覧ページにリダイレクト
        return redirect()->route('admin.article_tags.index')
            ->with('success', '削除処理が完了しました');
    }
}
