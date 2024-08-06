@extends('layouts.app')

@section('content')
    <div class="container mt-3" style="max-width: 800px;">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group" style="background-color: #fff;">
                    @foreach ($articles as $article)
                        <div class="list-group-item mb-0 pb-2 border-0" style="background-color: #fff;">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <small>{{ $article->member ? $article->member->name : 'Unknown' }} が {{ $article->created_at->format('Y年m月d日') }} に投稿</small>
                                    <h5 class="mb-1 font-weight-bold">{{ $article->title }}</h5>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                @foreach ($article->tags as $tag)
                                    <span class="badge bg-primary me-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr class="my-1 mx-4">
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
@endsection
