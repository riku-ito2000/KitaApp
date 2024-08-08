@extends('layouts.simple')

@section('content')
    <div class="container py-3 d-flex justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card" style="background-color: white;">
                <div class="card-header">パスワード変更</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="current_password">現在のパスワード</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required style="background-color: white;">
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password">新しいパスワード</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required style="background-color: white;">
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password_confirmation">新しいパスワード（確認）</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required style="background-color: white;">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn" style="background-color: #5a5; color: white; border: none; border-radius: 25px;">更新する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
