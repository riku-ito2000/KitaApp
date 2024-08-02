@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
            <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </button>
        </div>

        <!-- ここに記事一覧を表示するコードを追加 -->
        <h1>記事一覧</h1>
        <!-- 記事をここに表示する -->
    </div>
@endsection
