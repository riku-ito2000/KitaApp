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
    protected function escapeLike(string $value): string
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
            $articles = Article::with(['member', 'tags'])->paginate(config('pagination.articles'));
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
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id', // 存在するタグかどうかの検証
        ]);

        $article = new Article;
        $article->title = $request->input('title');
        $article->contents = $request->input('contents');
        $article->member_id = auth()->id();
        $article->save();

        $article->tags()->sync($request->input('tags', []));

        return redirect()->route('articles.edit', $article->id)->with('success', '記事投稿が完了しました');
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $article = Article::with('tags')->findOrFail($id);
        $tags = ArticleTag::all();

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

        return redirect()->route('articles.edit', $article->id)->with('success', '記事が更新されました');
    }
}
