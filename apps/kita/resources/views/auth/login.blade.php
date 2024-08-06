@extends('layouts.simple')

@section('content')
    <div class="container d-flex flex-column justify-content-start align-items-center" style="min-height: 100vh; margin-top: 50px;">
        <h1 class="mb-1" style="font-size: 25px; font-family: 'Poppins', sans-serif; font-weight: 300; color: #333; width: 500px; text-align: left;">
            Kitaログイン
        </h1>
        <div style="width: 100%; max-width: 500px; border-bottom: 1px solid #333; margin-bottom: 10px;"></div>
        <div class="card shadow-sm p-3 mb-5 bg-white rounded position-relative" style="width: 100%; max-width: 500px; font-family: 'Poppins', sans-serif; color: #333;">
            <div class="card-body" style="padding-top: 10px;">
                <div class="d-flex justify-content-end align-items-center mb-3">
                    <span style="font-size: 16px; color: #666; font-weight: normal;">新規会員登録は <a href="{{ route('register') }}" class="text-primary">こちら</a></span>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label" style="font-size: 16px; color: #000;">メールアドレス</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #fff;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label" style="font-size: 17px; color: #000;">パスワード</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: #fff;">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 text-left">
                        <button type="submit" class="btn btn-success" style="background-color: #8BC34A; border: none;">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
