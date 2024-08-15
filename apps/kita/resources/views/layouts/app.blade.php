<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Kita') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: #e0e0e0;">

<!-- ナビバーのセクション -->
@hasSection('navbar')
    <header>
        <nav class="navbar navbar-expand-md" style="height: 70px; background-color: #ffffff;">
            <div class="container d-flex justify-content-center align-items-center" style="max-width: 800px;">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="background-color: #5a5; color: white; border-radius: 50px; padding: 10px 40px; font-size: 1.5rem; border-radius: 50px 50px 50px 50px;">
                    {{ config('app.name', 'Kita') }}
                </a>
                <ul class="navbar-nav ms-auto">
                    @guest
                        <!-- ログインしていない場合に表示されるナビゲーションリンク -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('articles.create') }}" class="btn" style="background-color: white; border: 2px solid #5a5; color: black; padding: 8px 30px;">
                                記事を作成する
                            </a>
                        </li>
                        <!-- ログインしている場合に表示されるナビゲーションリンク -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    {{ __('ログアウト') }}
                                </a>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>
    </header>
@endif

<main style="background-color: #e0e0e0; padding-top: 50px;">
    <div class="py-3">
            @yield('container')
    </div>
</main>
</body>
</html>

