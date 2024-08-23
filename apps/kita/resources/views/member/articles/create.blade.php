@extends('layouts.app')

@section('navbar')
    <!-- このセクションを空にすることで、app.blade.php のナビバーが表示 -->
@endsection

@section('container')
    <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
        <!-- フラッシュメッセージ -->
        @include('common.messages')

        <form method="POST" action="{{ route('member.articles.store') }}">
            @csrf

            <div class="form-group mb-4">
                <label for="title">タイトル</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required
                       style="border: 1px solid #5a5; background-color: #ffffff;">
                @error('title')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="tags">タグ</label>
                <select multiple class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags[]"
                        style="border: 1px solid #5a5; background-color: #ffffff;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tags')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="contents">記事内容</label>
                <textarea class="form-control @error('contents') is-invalid @enderror" id="contents" name="contents" rows="10" required
                          style="border: 1px solid #5a5; background-color: #ffffff;">{{ old('contents') }}</textarea>
                @error('contents')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn" style="background-color: #5a5; color: white; padding: 5px 10px;">投稿する</button>
            </div>
        </form>
    </div>
@endsection

