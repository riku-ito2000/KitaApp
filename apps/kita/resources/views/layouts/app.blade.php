<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Kita'))</title>

    <!-- BootstrapのCSSを正しいURLで読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- カスタムCSSの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- フォントの読み込み -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- AdminLTEのCSSを読み込み -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>
<!-- AdminLTEのbodyクラスを追加 -->
<body class="hold-transition sidebar-mini sidebar-collapse" style="background-color: {{ request()->is('admin/*') ? '#fafafa' : '#e0e0e0' }};">
<!-- ログイン・会員登録ページでない場合のみnavbarを表示 -->
@if (!request()->is('login') && !request()->is('member_registration') && !request()->is('/') && !request()->is('admin/login'))
    @if (request()->is('admin/*'))
        @include('common.adminHeader')
        @include('common.adminSidebar')
    @else
        @include('common.header')
    @endif
@endif

<main style="background-color: {{ request()->is('admin/*') ? '#fafafa' : '#e0e0e0' }};
                  padding-top: {{ request()->is('admin/*') ? '20px' : '50px' }};">
    <div class="py-3">
    @yield('container')
</main>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- BootstrapのJavaScriptファイルの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTEのスクリプトを読み込み -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<!-- その他のカスタムスクリプト -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
