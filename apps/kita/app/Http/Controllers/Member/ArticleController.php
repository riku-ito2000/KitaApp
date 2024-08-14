<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected function escapeLike(string $value): string
    {
        return addcslashes($value, '%_\\');
    }

    public function index(Request $request)
    {
        $query = trim($request->input('query'));
        $paginationLimit = config('pagination.articles', 10);

        if ($query) {
            $escapedQuery = $this->escapeLike($query);
            $articles = Article::where('title', 'LIKE', "%{$escapedQuery}%")
                ->orWhere('contents', 'LIKE', "%{$escapedQuery}%")
                ->with(['member', 'tags'])
                ->paginate($paginationLimit)
                ->appends(['query' => $query]);
        } else {
            $articles = Article::with(['member', 'tags'])->paginate($paginationLimit);
        }

        $message = $articles->isEmpty() ? '記事が見つかりませんでした' : null;

        return view('articles.index', compact('articles', 'message'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        $paginationLimit = config('pagination.pagination_limit', 10);

        $escapedQuery = $this->escapeLike($query);
        $articles = Article::where('title', 'LIKE', "%{$escapedQuery}%")
            ->orWhere('contents', 'LIKE', "%{$escapedQuery}%")
            ->with(['member', 'tags'])
            ->paginate($paginationLimit)
            ->appends(['query' => $query]);

        $message = $articles->isEmpty() ? '記事が見つかりませんでした' : null;

        return view('articles.index', compact('articles', 'message'));
    }

    public function create()
    {
        return view('member.articles.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 記事を保存
        $article = Article::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'member_id' => auth()->id(),  // ログインユーザーのIDを保存
        ]);

        // フラッシュメッセージを設定
        return redirect()->route('articles.edit', $article->id)
            ->with('success', '記事を投稿しました。');
    }
}
