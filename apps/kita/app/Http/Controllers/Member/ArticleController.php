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

        return view('member.articles.index', compact('articles', 'message'));
    }
}
