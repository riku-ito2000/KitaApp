@extends('layouts.app')

@section('title', '管理者編集 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理 - 編集</h2>
        <!-- フラッシュメッセージ -->
        @include('common.messages')

        <div class="row justify-content-start">
            <!-- 左側のフォーム -->
            <div class="col-md-8">
                <!-- カード全体の背景を白に -->
                <div class="card text-start" style="background-color: #ffffff;">
                    <div class="card-body">
                        <!-- フォームにIDを設定 -->
                        <form action="{{ route('admin.admin_users.update', $admin_user->id) }}" method="POST" id="updateForm">
                            @csrf
                            @method('PUT')

                            <!-- IDフィールド -->
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" name="id" class="form-control" value="{{ $admin_user->id }}" readonly style="background-color: #f0f0f0;">
                            </div>

                            <!-- 姓フィールド -->
                            <div class="mb-3">
                                <label for="last_name" class="form-label">姓 <span class="badge bg-danger">必須</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $admin_user->last_name) }}" required>
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 名フィールド -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">名 <span class="badge bg-danger">必須</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $admin_user->first_name) }}" required>
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- メールアドレスフィールド -->
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス <span class="badge bg-danger">必須</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin_user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- パスワードフィールド -->
                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                <small class="text-muted">変更する場合のみ入力してください</small>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 更新日時フィールド -->
                            <div class="mb-3">
                                <label for="updated_at" class="form-label">更新日時</label>
                                <input type="text" id="updated_at" class="form-control" value="{{ $admin_user->updated_at->format('Y/m/d H:i:s') }}" readonly style="background-color: #f0f0f0;">
                            </div>

                            <!-- 登録日時フィールド -->
                            <div class="mb-3">
                                <label for="created_at" class="form-label">登録日時</label>
                                <input type="text" id="created_at" class="form-control" value="{{ $admin_user->created_at->format('Y/m/d H:i:s') }}" readonly style="background-color: #f0f0f0;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 右側のコンテナ（更新・削除ボタン）-->
            <div class="col-md-4 d-flex align-items-start">
                <div class="card w-100" style="background-color: #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <!-- 更新ボタン -->
                        <button type="submit" form="updateForm" class="btn btn-primary w-100 mb-3">更新する</button>

                        <!-- 削除ボタン -->
                        <form action="{{ route('admin.admin_users.destroy', $admin_user->id) }}" method="POST" id="deleteForm" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
