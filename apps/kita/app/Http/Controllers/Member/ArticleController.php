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
}
