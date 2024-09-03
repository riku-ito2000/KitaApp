@extends('layouts.app')

@section('title', $article->title . ' - Kita')

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- フラッシュメッセージ -->
        @include('common.messages')
        @if (auth()->check() && auth()->id() === $article->member_id)
            <div class="d-flex justify-content-end mb-3">
                <!-- 削除ボタン -->
                <a href="{{ route('articles.destroy', $article->id) }}"
                   class="btn btn-success rounded-pill py-2 px-4"
                   style="background-color: #dc3545; border-color: #dc3545;" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    削除する
                </a>
                <!-- 編集ボタン -->
                <a href="{{ route('articles.edit', $article->id) }}"
                   class="btn btn-success rounded-pill py-2 px-4 ms-2"
                   style="background-color: #8BC34A; border-color: #8BC34A;">
                    編集する
                </a>

            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- 記事タイトル -->
            <h1 class="mb-3 fw-bold fs-2">{{ $article->title }}</h1>
        </div>

        <!-- 投稿者情報 -->
        <small class="text-muted">
            {{ $article->member ? $article->member->name : 'Unknown' }}が{{ $article->created_at->format('Y年m月d日') }}に投稿
        </small>

        <!-- 記事のタグ -->
        <div class="mb-3 mt-2">
            @foreach($article->tags as $tag)
                <span class="badge bg-primary me-1">{{ $tag->name }}</span>
            @endforeach
        </div>

        <!-- 記事の内容 -->
        <p class="whitespace-pre-line">{!! nl2br(e($article->contents)) !!}</p>
    </div>

    <!-- コメントセクション -->
    <div class="container mt-5 py-4 border rounded" style="background-color: #ffffff; max-width: 800px;">
        <!-- アンダーラインを引く部分 -->
        <div class="mx-n3">
            <h3 class="mb-4 fw-bold px-3">コメント</h3>
            <!-- アンダーライン -->
            <hr class="border-top border-2 border-dark m-0">
        </div>

        <!-- コメントのリストコンテナ -->
        <div class="container mb-4 px-1">
            @if($comments->isEmpty())
                <p class="text-center text-muted fw-bold" style="font-size: 1.0rem;">コメントがありません。</p>
            @else
                @foreach($comments as $comment)
                    <div class="mb-4 p-3 bg-white">
                        <small class="text-muted">{{ $comment->member->name }}が{{ $comment->created_at->format('Y年m月d日') }}に投稿</small>
                        <p class="mt-2">{!! nl2br(e($comment->contents)) !!}</p>
                    </div>
                    @if (!$loop->last)
                        <!-- 区切り線 -->
                        <hr class="border-top border-2 border-dark w-100 m-0">
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
            {{-- コメント投稿フォーム追加予定 --}}
        </div>
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
                        一度削除すると元に戻せません。<br>よろしいですか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">削除する</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 削除フォーム -->
        <form id="deleteForm" action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: none;">
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
