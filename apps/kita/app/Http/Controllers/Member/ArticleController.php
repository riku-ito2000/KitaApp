<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @param string $value
     * @return string
     */
    private function escapeLike(string $value): string
    {
        return addcslashes($value, '%_\\');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // タグを全て取得してビューに渡す
        $tags = ArticleTag::all();

        // ビューに $tags を渡す
        return view('member.articles.create', compact('tags'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // 指定されたIDに基づいて記事を取得
        $article = Article::with('tags')->findOrFail($id);

        // すべてのタグを取得
        $tags = ArticleTag::all();

        // ビューに記事とタグを渡す
        return view('member.articles.edit', compact('article', 'tags'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        // 記事を取得し、関連するタグ、メンバー、およびコメントをロードする
        $article = Article::with('tags', 'member', 'comments.member')->findOrFail($id);

        // コメントを最新の順に並べ替える（必要であれば）
        $comments = $article->comments->sortByDesc('created_at');

        return view('member.articles.show', compact('article', 'comments'));
    }
}
