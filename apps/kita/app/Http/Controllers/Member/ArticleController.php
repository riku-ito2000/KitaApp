<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['member', 'tags'])->paginate(config('pagination.articles'));

        return view('member.articles.index', compact('articles'));

    }

    public function show($id)
    {
        // 指定されたIDに基づいて記事を取得
        $article = Article::with(['member', 'tags'])->findOrFail($id);

        // 記事詳細ページのビューを返す
        return view('member.articles.show', compact('article'));
    }
}
