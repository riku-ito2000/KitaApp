@extends('layouts.app')

@section('title', $article->title . ' - Kita')

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- 記事タイトル -->
            <h1 class="mb-3" style="font-weight: 700; font-size: 2rem;">{{ $article->title }}</h1>

            <!-- 編集ボタンと削除ボタン -->
{{--            <div>--}}
{{--                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-success me-2" style="background-color: #6c757d; border: none;">--}}
{{--                    編集する--}}
{{--                </a>--}}
{{--                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger" style="background-color: #dc3545; border: none;">--}}
{{--                        削除する--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>

        <!-- 投稿者情報 -->
        <small class="text-muted">
            {{ $article->member ? $article->member->name : 'Unknown' }}が{{ $article->created_at->format('Y年m月d日') }}に投稿
        </small>

        <!-- 記事のタグ -->
        <div class="mb-3 mt-2">
            @foreach($article->tags as $tag)
                <span class="badge bg-primary me-1" style="background-color: #007bff;">{{ $tag->name }}</span>
            @endforeach
        </div>

        <!-- 記事の内容 -->
        <p style="white-space: pre-line;">{{ $article->contents }}</p>
    </div>

    <!-- コメントセクション -->
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <h3 class="mb-4" style="font-weight: 700;">コメント</h3>

        @foreach($comments as $comment)
            <div class="mb-4 p-3" style="border: 1px solid #ddd; border-radius: 5px;">
                <small class="text-muted">{{ $comment->user->name }}が{{ $comment->created_at->format('Y年m月d日') }}に投稿</small>
                <p class="mt-2">{{ $comment->content }}</p>
            </div>
    @endforeach
@endsection
