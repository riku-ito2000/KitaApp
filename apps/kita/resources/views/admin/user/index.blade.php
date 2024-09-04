@extends('layouts.app')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理</h2>

        <!-- 検索フォーム -->
        <form action="{{ route('admin.index') }}" method="GET">
            <div class="p-4 mb-0" style="background-color: #ffffff; border-radius: 8px 8px 0 0; border: 1px solid grey; border-bottom: none;">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="last-name" class="form-label">姓</label>
                        <input type="text" id="last-name" name="last_name" class="form-control" style="background-color: #ffffff;" value="{{ request('last_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="first-name" class="form-label">名</label>
                        <input type="text" id="first-name" name="first_name" class="form-control" style="background-color: #ffffff;" value="{{ request('first_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input type="email" id="email" name="email" class="form-control" style="background-color: #ffffff;" value="{{ request('email') }}">
                    </div>
                </div>
            </div>

            <div class="px-4 py-2" style="background-color: #f0f0f0; border-radius: 0 0 8px 8px; border: 1px solid grey; border-top: none;">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        検索
                    </button>
                </div>
            </div>
        </form>


        <!-- ページネーション -->
        <div class="d-flex justify-content-start mt-3">
            {{ $admin_users->links('vendor.pagination.custom') }}
        </div>

        <div class="p-4 mb-4" style="background-color: #ffffff; border-radius: 8px;">
            <div class="mb-3">
                <button type="button" class="btn btn-primary">新規登録</button>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>更新日時</th>
                    <th>登録日時</th>
                    <th>レコード操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admin_users as $admin_user)
                    <tr>
                        <td>{{ $admin_user->id }}</td>
                        <td>{{ $admin_user->first_name }} {{ $admin_user->last_name }}</td>
                        <td>{{ $admin_user->email }}</td>
                        <td>{{ $admin_user->updated_at->format('Y/m/d H:i') }}</td>
                        <td>{{ $admin_user->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">編集</button>
                        </td>
                    </tr>
                @endforeach
                <!-- フラッシュメッセージ -->
                @include('common.messages')
                </tbody>
            </table>

        </div>
    </div>
@endsection

