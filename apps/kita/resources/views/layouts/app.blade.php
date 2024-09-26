<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Kita'))</title>

    <!-- カスタム CSS の読み込み（必要に応じて適宜追加） -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- フォントの読み込み -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<!-- AdminLTE の body クラスを追加 -->
<body class="hold-transition sidebar-mini sidebar-mini-hover" style="background-color: {{ request()->is('admin/*') ? '#fafafa' : '#e0e0e0' }};">
<div class="wrapper">
    <!-- ログイン・会員登録ページでない場合のみ navbar を表示 -->
    @if (!request()->is('login') && !request()->is('member_registration') && !request()->is('/') && !request()->is('admin/login'))
        @if (request()->is('admin/*'))
            @include('common.adminHeader')
            @include('common.adminSidebar')
        @else
            @include('common.header')
        @endif
    @endif

    <!-- コンテンツエリア -->
    <div class="content-wrapper {{ request()->is('admin/*') ? 'ms-3' : 'ms-0' }}" style="{{ request()->is('admin/*') ? 'margin-left: 250px;' : '' }}">
        <main class="pt-{{ request()->is('admin/*') ? '3' : '5' }} px-3">
            <div class="py-3">
                @yield('container')
            </div>
        </main>
    </div>

    <!-- その他のカスタムスクリプト -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</div>
</body>
</html>
