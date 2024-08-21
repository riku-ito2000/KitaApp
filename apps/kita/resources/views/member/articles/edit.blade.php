@extends('layouts.app')

@section('navbar')
    <!-- このセクションを空にすることで、app.blade.php のナビバーが表示 -->
@endsection

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- フラッシュメッセージ -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.store')}}">
            @csrf
            <div class="form-group mb-4">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required
                       style="border: 1px solid #5a5; background-color: #ffffff;">
            </div>

            <div class="form-group mb-4">
                <label for="tags">タグ</label>
                <select multiple class="form-control" id="tags" name="tags[]"
                        style="border: 1px solid #5a5; background-color: #ffffff;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="contents">記事内容</label>
                <textarea class="form-control" id="contents" name="contents" rows="10" required
                          style="border: 1px solid #5a5; background-color: #ffffff;">{{ old('contents', $article->contents) }}</textarea>
            </div>
        </form>
    </div>
@endsection
