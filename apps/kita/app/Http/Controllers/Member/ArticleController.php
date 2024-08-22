<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Escape special characters for LIKE queries.
     *
     * @param string $value
     * @return string
     */
    private function escapeLike(string $value): string
    {
        return addcslashes($value, '%_\\');
    }

    /**
     * Display a listing of the articles.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = trim($request->input('search'));
        $paginationLimit = config('pagination.articles', 10);

        if ($query) {
            $escapedQuery = $this->escapeLike($query);
            $articles = Article::where('title', 'LIKE', "%{$escapedQuery}%")
                ->orWhere('contents', 'LIKE', "%{$escapedQuery}%")
                ->with(['member', 'tags'])
                ->paginate($paginationLimit)
                ->appends(['search' => $query]);
        } else {
            $articles = Article::with(['member', 'tags'])->paginate($paginationLimit);
        }

        $message = $articles->isEmpty() ? '記事が見つかりませんでした' : null;

        return view('member.articles.index', compact('articles', 'message'));
    }

    /**
     * Show the form for creating a new article.
     *
     * @return View
     */
    public function create(): View
    {
        $tags = ArticleTag::all();

        // ビューに $tags を渡す
        return view('member.articles.create', compact('tags'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーションの適用
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id', // 存在するタグかどうかの検証
        ]);

        // member_idをリクエストデータに追加
        $validatedData['member_id'] = auth()->id();

        // 記事の保存処理
        $article = new Article;
        $article->fill($validatedData)->save(); // fillメソッドを使用して複数のカラムに値をセット

        // タグの関連付け
        $article->tags()->sync($request->input('tags', []));

        // 新しく作成した記事の編集ページにリダイレクト
        return redirect()->route('member.articles.edit', $article->id)->with('success', '記事投稿が完了しました');
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        // 指定されたIDに基づいて記事を取得
        $article = Article::with('tags')->findOrFail($id);

        // すべてのタグを取得
        $tags = ArticleTag::all();

        // ビューに記事とタグを渡す
        return view('member.articles.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        // バリデーションの適用
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id',
        ]);

        $article->update([
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
        ]);

        $article->tags()->sync($request->input('tags', []));

        return redirect()->route('member.articles.edit', $article->id)->with('success', '記事が更新されました');
    }
}
