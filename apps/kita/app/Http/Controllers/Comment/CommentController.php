<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comments' => 'required|string|max:1000',
            'article_id' => 'required|exists:articles,id', // article_id のバリデーションを追加
        ]);

        ArticleComment::create([
            'contents' => $validated['comments'],
            'member_id' => auth()->id(),
            'article_id' => $validated['article_id'], // バリデーションされた article_id を使用
        ]);

        return back()->with('success', 'コメントを投稿しました');
    }
}
