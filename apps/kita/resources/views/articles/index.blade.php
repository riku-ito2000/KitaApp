@extends('layouts.simple')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- ここに記事一覧を表示するコードを追加 -->
        <h1>記事一覧</h1>
        <!-- 記事をここに表示する -->
    </div>
@endsection
