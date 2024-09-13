@extends('layouts.app')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理</h2>
        <!-- フラッシュメッセージ -->
        @include('common.messages')

        <!-- 検索フォーム -->
        <form action="{{ route('admin.admin_users.index') }}" method="GET">
            <div class="p-4 mb-0 rounded-top border border-bottom-0 bg-white border">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="last-name" class="form-label">姓</label>
                        <input type="text" id="last-name" name="last_name" class="form-control bg-white" value="{{ request('last_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="first-name" class="form-label">名</label>
                        <input type="text" id="first-name" name="first_name" class="form-control bg-white" value="{{ request('first_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input type="text" id="email" name="email" class="form-control bg-white" value="{{ request('email') }}">
                    </div>
                </div>
            </div>


            <div class="px-4 py-2 rounded-bottom border border-top-0 bg-light">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        検索
                    </button>
                </div>
            </div>
        </form>

        <!-- ページネーション -->
        <div class="d-flex justify-content-start mt-3">
            {{ $adminUsers->links('vendor.pagination.custom') }}
        </div>

        {{--新規登録ボタン--}}
        <div class="p-3 mb-4 bg-white rounded">
        <form action="{{ route('admin.admin_users.create') }}" method="GET">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">新規登録</button>
                </div>
            </form>

            {{--この色指定だけは、変えてしまうとデフォルト設定の色になってしまう--}}
            <table class="table table-bordered align-middle" style="--bs-table-bg: #ffffff;">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th class="text-end">更新日時</th>
                    <th class="text-end">登録日時</th>
                    <th class="text-center">レコード操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($adminUsers as $adminUser)
                    <tr>
                        <td class="text-center py-1">{{ $adminUser->id }}</td>
                        <td class="py-1">{{ $adminUser->first_name }} {{ $adminUser->last_name }}</td>
                        <td class="py-1">{{ $adminUser->email }}</td>
                        <td class="text-end py-1">{{ $adminUser->updated_at->format('Y/m/d H:i') }}</td>
                        <td class="text-end py-1">{{ $adminUser->created_at->format('Y/m/d H:i') }}</td>
                        <td class="text-center py-1">
                            <button type="button" class="btn btn-primary btn-sm">編集</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
