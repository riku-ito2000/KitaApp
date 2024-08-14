@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding: 20px;">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h2 class="mb-4">プロフィール編集</h2>
                <hr>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name">ユーザー名</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $member->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">メールアドレス</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $member->email) }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">パスワード</label>
                        <div class="d-flex align-items-center">
                            <span class="me-3">*****</span>
                            <a href="{{ route('password.change.form') }}" class="btn" style="background-color: #5a5; color: white; border: none; border-radius: 25px;">パスワードを変更する</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn" style="background-color: #5a5; color: white; border: none; border-radius: 25px;">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
