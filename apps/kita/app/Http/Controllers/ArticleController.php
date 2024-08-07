<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $paginationLimit = config('pagination.articles', 10);

        if ($query) {
            $articles = Article::where('title', 'LIKE', "%{$query}%")
                ->orWhere('contents', 'LIKE', "%{$query}%")
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
        $query = $request->input('query');
        $paginationLimit = config('pagination.pagination_limit', 10);

        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('contents', 'LIKE', "%{$query}%")
            ->with(['member', 'tags'])
            ->paginate($paginationLimit)
            ->appends(['query' => $query]);

        $message = $articles->isEmpty() ? '記事が見つかりませんでした' : null;

        return view('articles.index', compact('articles', 'message'));
    }
}
