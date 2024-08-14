@extends('layouts.app')

@section('container')
    <div class="container d-flex flex-column justify-content-start align-items-center" style="min-height: 100vh;">
        <h1 class="mb-1" style="font-size: 30px; font-family: 'Poppins', sans-serif; font-weight: 300; color: #333; width: 500px; text-align: left;">
            Kita会員登録
        </h1>
        <div style="width: 500px; border-bottom: 1px solid #333; margin: 10px 0 20px 0;"></div>
        <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="width: 500px; font-family: 'Poppins', sans-serif; color: #333;">
            <div class="card-body" style="padding: 0; margin: 0 10px 0 10px;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">ユーザー名</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="background-color: #fff;">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="background-color: #fff;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">パスワード</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background-color: #fff;">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm" class="form-label">パスワード（確認用）</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background-color: #fff;">
                    </div>

                    <div class="form-group mb-0 text-left">
                        <button type="submit" class="btn btn-success" style="background-color: #8BC34A; border: none;">
                            登録する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
