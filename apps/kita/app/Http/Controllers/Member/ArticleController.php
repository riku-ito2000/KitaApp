<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Auth\Access\AuthorizationException;
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
                ->orderBy('created_at', 'desc') // 新しい順に並べ替え
                ->paginate($paginationLimit)
                ->appends(['search' => $query]);
        } else {
            $articles = Article::with(['member', 'tags'])
                ->orderBy('created_at', 'desc') // 新しい順に並べ替え
                ->paginate($paginationLimit);
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
        // タグを全て取得してビューに渡す
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
        $validatedData = $this->validateArticle($request);

        // member_idをリクエストデータに追加
        $validatedData['member_id'] = auth()->id();

        // 記事の保存処理
        $article = new Article;
        $article->fill($validatedData)->save(); // fillメソッドを使用して複数のカラムに値をセット

        // タグの関連付け
        $article->tags()->sync($request->input('tags', []));

        // 新しく作成した記事の編集ページにリダイレクト
        return redirect()->route('articles.edit', $article->id)->with('success', '記事投稿が完了しました');
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param Article $article
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Article $article): View
    {
        // 記事の所有権を確認
        $this->authorizeArticle($article);

        // すべてのタグを取得
        $tags = ArticleTag::all();

        // ビューに記事とタグを渡す
        return view('member.articles.edit', compact('article', 'tags'));
    }

    /**
     * Display the articles with members and comments
     *
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show(Article $article)
    {
        // 'member' と 'tags' のリレーションシップをロード
        $article->load(['member', 'tags', 'comments.member']);

        // コメントを最新の順に並べ替える（必要であれば）
        $comments = $article->comments->sortByDesc('created_at');

        return view('member.articles.show', compact('article', 'comments'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        // 記事の所有権を確認
        $this->authorizeArticle($article);

        // バリデーションの適用
        $validatedData = $this->validateArticle($request);

        $article->update([
            'title' => $validatedData['title'],
            'contents' => $validatedData['contents'],
        ]);

        $article->tags()->sync($request->input('tags', []));

        return redirect()->route('articles.edit', $article->id)->with('success', '記事が更新されました');
    }

    /**
     * Validate the article input.
     *
     * @param Request $request
     * @return array
     */
    private function validateArticle(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id',
        ]);
    }

    /**
     * Check if the authenticated user owns the article.
     *
     * @param Article $article
     * @throws AuthorizationException
     */
    private function authorizeArticle(Article $article): void
    {
        if ($article->member_id !== auth()->id()) {
            abort(403, 'この記事を編集する権限がありません。');
        }
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->authorizeArticle($article);
        $article->delete();

        return redirect()->route('member.articles.index')->with('success', '記事が削除されました。');
    }
}
