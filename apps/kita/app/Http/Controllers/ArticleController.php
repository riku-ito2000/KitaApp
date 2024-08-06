<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['member', 'tags'])->paginate(config('pagination.articles'));

        return view('articles.index', compact('articles'));
    }
}
