@extends('layouts.app')

@section('title', $article->title . ' - Kita')

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- フラッシュメッセージ -->
        @include('common.messages')
        @if (auth()->check() && auth()->id() === $article->member_id)
            <!-- 編集ボタン -->
            <div class="d-flex justify-content-end mb-3" style="position: relative; top: -5px;">
                <a href="{{ route('member.articles.edit', $article->id) }}" class="btn btn-success me-2" style="background-color: #8BC34A; border: none; border-radius: 18px; padding: 8px 18px;">
                    編集する
                </a>
            </div>
        @endif
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
        <p style="white-space: pre-line;">{!! nl2br(e($article->contents)) !!}</p>
    </div>
@endsection
