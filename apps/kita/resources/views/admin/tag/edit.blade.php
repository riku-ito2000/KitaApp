@extends('layouts.app')

@section('title', '管理者編集 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">タグ管理 - 編集</h2>
        <!-- フラッシュメッセージ -->
    @include('common.messages')
        <form action="{{ route('admin.article_tags.update', $articleTag->id) }}" method="POST" id="updateForm" class="w-100">
            @csrf
            @method('PUT')

            <div class="row justify-content-start">
                <!-- 左側のフォーム -->
                <div class="col-md-8">
                    <!-- カード全体の背景を白に -->
                    <div class="card text-start bg-white">
                        <div class="card-body">
                            <!-- IDフィールド -->
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" name="id" class="form-control bg-light" value="{{ $articleTag->id }}" readonly>
                            </div>

                            <!-- 名フィールド -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">タグ名 <span class="badge bg-danger text-white">必須</span></label>
                                <input type="text" id="name" name="tag_name" class="form-control bg-white @error('tag_name') is-invalid @enderror" value="{{ old('tag_name', $articleTag->name) }}" required>
                                @error('tag_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 更新日時フィールド -->
                            <div class="mb-3">
                                <label for="updated_at" class="form-label">更新日時</label>
                                <input type="text" id="updated_at" class="form-control bg-light" value="{{ $articleTag->updated_at->format('Y/m/d H:i:s') }}" readonly>
                            </div>

                            <!-- 登録日時フィールド -->
                            <div class="mb-3">
                                <label for="created_at" class="form-label">登録日時</label>
                                <input type="text" id="created_at" class="form-control bg-light" value="{{ $articleTag->created_at->format('Y/m/d H:i:s') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 右側のコンテナ（更新・削除ボタン）-->
                <div class="col-md-4 d-flex align-items-start">
                    <div class="card w-100 bg-white">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <!-- 更新ボタン -->
                            <button type="submit" form="updateForm" class="btn btn-primary w-100 mb-3">更新する</button>

                            <!-- 削除ボタン（モーダルをトリガー） -->
                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAdminUserModal-{{ $articleTag->id }}">削除する</button>

                            <!-- 削除確認モーダルの呼び出し -->
                            @include('modals.modal_delete', [
                                'modalId' => 'deleteAdminUserModal-' . $articleTag->id,
                                'formId' => 'deleteAdminUserForm-' . $articleTag->id,
                                'deleteRoute' => route('admin.article_tags.destroy', $articleTag->id),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
