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

    <!-- フォントの読み込み -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: #e0e0e0;">
<!-- ログイン・会員登録ページでない場合のみnavbarを表示 -->
@if (!request()->is('login') && !request()->is('member_registration'))
    @include('common.header')
@endif

<main style="background-color: #e0e0e0; padding-top: 50px;">
    <div class="py-3">
        @yield('container')
    </div>
</main>

<!-- BootstrapのJavaScriptファイルの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

