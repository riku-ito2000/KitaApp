@extends('layouts.app')

@section('container')

    <div class="container">
        <h2 class="mb-4">タグ管理</h2>
        <!-- フラッシュメッセージ -->
        @include('common.messages')

        <!-- 検索フォーム -->
        <form action="{{ route('admin.article_tags.index') }}" method="GET">
            <div class="p-4 mb-0 rounded-top border border-bottom-0 bg-white border">
                <div class="row g-1"> <!-- g-3 を g-1 に変更して隙間を狭く -->
                    <label for="tag-name" class="form-label mb-1">タグ名</label> <!-- mb-1 を追加してラベル下のマージンを狭く -->
                    <input type="text" id="tag-name" name="tag_name" class="form-control bg-white" value="{{ request('tag_name') }}">
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
            {{ $tags->links('vendor.pagination.custom') }}
        </div>

        {{--新規登録ボタン--}}
        <div class="p-4 mb-4 bg-white" style="border-radius: 8px;">
            <form action="{{ route('admin.article_tags.create') }}" method="GET">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">新規登録</button>
                </div>
            </form>

            {{--この色指定だけは、変えてしまうとデフォルト設定の色になってしまう--}}
            <table class="table table-bordered align-middle" style="--bs-table-bg: #ffffff;">
                <thead>
                <tr>
                    <th class="text-center w-10">ID</th>
                    <th class="w-50">タグ名</th>
                    <th class="text-end w-30">登録日時</th>
                    <th class="text-center w-10">レコード操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td class="text-center py-1 w-10">{{ $tag->id }}</td>
                        <td class="py-1 w-50">{{ $tag->name }}</td>
                        <td class="text-end py-1 w-30">{{ $tag->created_at->format('Y/m/d H:i') }}</td>
                        <td class="text-center py-1 w-10">
                            <button type="button" class="btn btn-primary btn-sm">編集</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
