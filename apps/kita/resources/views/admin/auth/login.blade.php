@extends('layouts.app')

@section('title', 'ログイン - Kita')

@section('container')
    <div class="container d-flex flex-column justify-content-start align-items-center" style="min-height: 100vh; margin-top: 50px;">
        <h1 class="mb-1 text-center" style="font-size: 50px; font-family: 'Montserrat', sans-serif; color: #333; text-align: center;">
            <span style="font-weight: 800;">K</span><span style="font-weight: 600;">ita</span>
            <span style="font-size: 30px; font-weight: 400;">Administrator console</span>
        </h1>
        <!-- スペースを追加 -->
        <div style="margin-bottom: 20px;"></div>
        <div class="card shadow-sm p-3 mb-5 bg-white rounded position-relative" style="width: 100%; max-width: 600px; font-family: 'Montserrat', sans-serif; color: #333;">
            <div class="card-body" style="padding-top: 10px;">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label" style="font-size: 16px; color: #000; font-family: 'Montserrat', sans-serif;">メールアドレス</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #fff;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label" style="font-size: 17px; color: #000; font-family: 'Montserrat', sans-serif;">パスワード</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: #fff;">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 text-left">
                        <button type="submit" class="btn btn-success" style="background-color: royalblue; border: none; font-family: 'Montserrat', sans-serif;">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
