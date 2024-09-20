@extends('layouts.app')

@section('title', '会員管理 - Kita')

@section('container')

    <div class="container">
        <h2 class="mb-4">会員管理</h2>

        <!-- 検索フォーム -->
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="p-4 mb-0 rounded-top border border-bottom-0 bg-white">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">ユーザー名</label>
                        <input type="text" id="name" name="name" class="form-control bg-white" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-6">
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
            {{ $members->links('vendor.pagination.custom') }}
        </div>

        {{--新規登録ボタン--}}
        <div class="p-4 mb-4 bg-white" style="border-radius: 8px;">

            {{-- テーブル --}}
            <table class="table table-bordered align-middle" style="--bs-table-bg: #ffffff;">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th class="text-end">登録日時</th>
                </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                    <tr>
                        <td class="text-center py-1">{{ $member->id }}</td>
                        <td class="py-1">{{ $member->name }}</td>
                        <td class="py-1">{{ $member->email }}</td>
                        <td class="text-end py-1">{{ $member->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
