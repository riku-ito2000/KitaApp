@extends('layouts.app')

@section('title', '管理者新規登録 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理 - 新規登録</h2>

        <form action="{{ route('admin.admin_users.store') }}" method="POST" id="registrationForm" class="w-100">
            @csrf
            <div class="row justify-content-start">
                <!-- 左側のフォーム -->
                <div class="col-md-8">
                    <!-- カード全体の背景を白に -->
                    <div class="card text-start bg-white">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">姓 <span class="badge bg-danger text-white">必須</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control bg-white @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="first_name" class="form-label">名 <span class="badge bg-danger text-white">必須</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control bg-white @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス <span class="badge bg-danger text-white">必須</span></label>
                                <input type="email" id="email" name="email" class="form-control bg-white @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード <span class="badge bg-danger text-white">必須</span></label>
                                <input type="password" id="password" name="password" class="form-control bg-white @error('password') is-invalid @enderror" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">パスワード（確認） <span class="badge bg-danger text-white">必須</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control bg-white @error('password_confirmation') is-invalid @enderror" required>
                                @error('password_confirmation')
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
