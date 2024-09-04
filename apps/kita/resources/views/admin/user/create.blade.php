@extends('layouts.app')

@section('title', '管理者新規登録 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理 - 新規登録</h2>

        <div class="row justify-content-start">
            <div class="col-md-8">
                <!-- カード全体の背景を白に -->
                <div class="card text-start" style="background-color: #ffffff;">
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="last_name" class="form-label">姓 <span class="badge bg-danger">必須</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" style="background-color: #ffffff;" required>
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="first_name" class="form-label">名 <span class="badge bg-danger">必須</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" style="background-color: #ffffff;" required>
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス <span class="badge bg-danger">必須</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" style="background-color: #ffffff;" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード <span class="badge bg-danger">必須</span></label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" style="background-color: #ffffff;" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">パスワード（確認） <span class="badge bg-danger">必須</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" style="background-color: #ffffff;" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
