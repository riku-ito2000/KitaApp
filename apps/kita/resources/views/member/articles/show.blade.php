@extends('layouts.app')

@section('title', $article->title . ' - Kita')

@section('container')
    <div class="container py-4 position-relative" style="background-color: #ffffff; max-width: 800px;">
        <!-- フラッシュメッセージ -->
        @include('common.messages')
        @if (auth()->check() && auth()->id() === $article->member_id)
            <!-- 編集ボタンと削除ボタン -->
            <div class="d-flex justify-content-end mb-3" style="position: relative; top: -5px;">
                <a href="{{ route('member.articles.edit', $article->id) }}" class="btn btn-success me-2" style="background-color: #8BC34A; border: none; border-radius: 18px; padding: 8px 18px;">
                    編集する
                </a>
                <!-- 削除ボタン -->
                <button type="button" class="btn btn-danger" style="background-color: #dc3545; border: none; border-radius: 18px; padding: 8px 18px;" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    削除する
                </button>
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

    @if (auth()->check() && auth()->id() === $article->member_id)
        <!-- 削除確認モーダル -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">削除確認</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        本当にこの記事を削除しますか？この操作は元に戻せません。
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">削除する</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 削除フォーム -->
        <form id="deleteForm" action="{{ route('member.articles.destroy', $article->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <script>
            document.getElementById('confirmDeleteButton').addEventListener('click', function () {
                document.getElementById('deleteForm').submit();
            });
        </script>
    @endif
@endsection
