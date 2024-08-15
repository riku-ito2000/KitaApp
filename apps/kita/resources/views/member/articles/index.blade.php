@extends('layouts.app')

@section('title', '記事一覧 - Kita')

@section('navbar')
    @include('common.header')
@endsection

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- ここに一覧画面の内容を記述 -->
        <div class="container mt-3" style="max-width: 800px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="list-group" style="background-color: #fff;">
                        @foreach ($articles as $article)
                            <div class="list-group-item mb-0 pb-2 border-0" style="background-color: #fff;">
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <!-- 投稿者名と日付の間の空白を削除し、フォントサイズを小さく -->
                                        <small class="text-muted" style="font-size: 0.75rem; margin-bottom: 0;">
                                            {{ $article->member ? $article->member->name : 'Unknown' }}が{{ $article->created_at->format('Y年m月d日') }}に投稿
                                        </small>
                                        <!-- タイトルのフォントサイズを大きく -->
                                        <h5 class="mb-1" style="font-weight: 800; color: #343a40; font-size: 1.5rem; margin-top: -5px;">
                                            {{ $article->title }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    @foreach ($article->tags as $tag)
                                        <span class="badge bg-primary me-1" style="border-radius: 3px;">{{ $tag->name }}</span>

                                    @endforeach
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-1 mx-3">
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3 d-flex justify-content-center" style="background-color: #fff;">
                        <div class="pagination-wrapper" style="background-color: #fff;">
                            {{ $articles->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
