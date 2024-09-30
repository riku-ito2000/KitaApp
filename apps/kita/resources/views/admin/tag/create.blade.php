@extends('layouts.app')

@section('title', 'タグ新規登録 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">タグ管理 - 新規登録</h2>

        <form action="{{ route('admin.article_tags.store') }}" method="POST" id="registrationForm" class="w-100">
            @csrf
            <div class="row justify-content-start">
                <!-- 左側のフォーム -->
                <div class="col-md-8">
                    <!-- カード全体の背景を白に -->
                    <div class="card text-start bg-white">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">タグ名 <span class="badge bg-danger text-white">必須</span></label>
                                <input type="text" id="name" name="tag_name" class="form-control bg-white @error('tag_name') is-invalid @enderror" value="{{ old('tag_name') }}" required>
                                @error('tag_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 右側のコンテナ（登録ボタン）-->
                <div class="col-md-4 d-flex align-items-start">
                    <div class="card w-100 bg-white">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <button type="submit" form="registrationForm" class="btn btn-primary w-100">登録する</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
