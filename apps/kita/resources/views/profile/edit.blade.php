@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-2 pb-4">
        <div class="row justify-content-center" style="margin: 0;">
            <div class="col-md-12" style="padding: 0;">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h2 class="mb-3" style="padding-bottom: 5px; margin: 0;">プロフィール編集</h2>
                <hr style="margin: 0;">

                <form method="POST" action="{{ route('profile.update') }}" style="padding-top: 10px; padding-bottom:10px;">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name">ユーザー名</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $member->name) }}" required style="background-color: white; width: 100%;">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">メールアドレス</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $member->email) }}" required style="background-color: white; width: 100%;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">パスワード</label>
                        <div class="d-flex align-items-center" style="width: 100%;">
                            <span class="me-3">*****</span>
                            <!-- モーダルをトリガーするボタン -->
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#passwordChangeModal" style="background-color: #5a5; color: white; border: none; border-radius: 25px;">
                                パスワードを変更する
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn" style="background-color: #5a5; color: white; border: none; border-radius: 25px;">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- パスワード変更モーダルをインクルード -->
    @include('modals.modal_password_change')

    <!-- エラーメッセージがある場合にモーダルを自動的に表示 -->
    @if ($errors->has('new_password') || $errors->has('new_password_confirmation'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('passwordChangeModal'), {});
                myModal.show();
            });
        </script>
    @endif
@endsection
