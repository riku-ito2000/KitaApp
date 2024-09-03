@extends('layouts.app')

@section('container')

    <div class="container">
        <h2 class="mb-4">管理者管理</h2>

        <form class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="姓">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="名">
                </div>
                <div class="col-md-4">
                    <input type="email" class="form-control" placeholder="メールアドレス">
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>

        <div class="mb-3">
            <button type="button" class="btn btn-primary">新規登録</button>
        </div>

        <table class="table table-striped">
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
                    <td>{{ $admin_user->name }}</td>
                    <td>{{ $admin_user->email }}</td>
                    <td>{{ $admin_user->updated_at->format('Y/m/d H:i') }}</td>
                    <td>{{ $admin_user->created_at->format('Y/m/d H:i') }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm">編集</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- ページネーション -->
        <div class="d-flex justify-content-center">
            {{ $admin_users->links() }}
        </div>
    </div>
@endsection

