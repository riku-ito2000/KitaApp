@extends('layouts.app')

@section('title', $article->title . ' - Kita')

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- 記事セクション -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- 記事タイトル -->
            <h1 class="mb-3" style="font-weight: 700; font-size: 2rem;">{{ $article->title }}</h1>
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
    <div class="container mt-5 py-4" style="background-color: #ffffff; max-width: 800px; border: 1px solid #ddd; border-radius: 5px;">
        <!-- アンダーラインを引く部分 -->
        <div style="margin-left: -13px; margin-right: -13px;">
            <h3 class="mb-4" style="font-weight: 700; padding-left: 16px; padding-right: 16px;">コメント</h3>
            <!-- アンダーライン -->
            <hr style="border-top: 2px solid #666; margin: 0;">
        </div>

        <!-- コメントのリストコンテナ -->
        <div class="container mb-4" style="padding-left: 5px; padding-right: 5px;">
            @if($comments->isEmpty())
                <p class="text-center text-muted" style="font-size: 1.0rem; font-weight: 700;">コメントがありません。</p>
            @else
                @foreach($comments as $comment)
                    <div class="mb-4 p-3" style="background-color: #ffffff;">
                        <small class="text-muted">{{ $comment->member->name }}が{{ $comment->created_at->format('Y年m月d日') }}に投稿</small>
                        <p class="mt-2">{!! nl2br(e($comment->contents)) !!}</p>
                    </div>
                    @if (!$loop->last)
                        <!-- 区切り線 -->
                        <hr style="border-top: 2px solid #666; width: 100%; margin-left: 0;">
                    @endif
                @endforeach
            @endif
        </div>

        <!-- 最後のアンダーライン用のコンテナ -->
        <div style="margin-left: -13px; margin-right: -13px;">
            <hr style="border-top: 2px solid #666; margin: 0;">
        </div>

        <!-- 別のコンテナ（例: コメントフォームや他の情報用） -->
        <div class="container">
            <!-- 他のコンテンツやフォームをここに追加できます -->
            <p>コメント投稿フォーム追加予定</p>
        </div>
    </div>
@endsection
