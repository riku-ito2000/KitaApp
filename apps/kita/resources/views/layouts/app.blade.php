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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTcYBfljt0MhGQ5BUsAXO6XvlOHP6FzJnDMEbca+maU1Ea5w5z2kPjszef6USF7GkAzzw2zB1nZzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style="background-color: #e0e0e0;">
<header>
    <nav class="navbar navbar-expand-md" style="height: 70px; background-color: #ffffff;">
        <div class="container d-flex justify-content-center align-items-center" style="max-width: 800px;">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="background-color: #5a5; color: white; border-radius: 50px; padding: 10px 40px; font-size: 1.5rem; border-radius: 50px 50px 50px 50px;">
                {{ config('app.name', 'Kita') }}
            </a>
            <form class="d-flex ms-3" action="{{ route('articles.index') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" type="search" name="query" placeholder="Search for something" aria-label="Search" style="width: 200px;" value="{{ request('query') }}">
                    <button class="btn" type="submit" style="background-color: #5a5; color: white; border: none;">検索</button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="profileDropdown" class="nav-link d-flex align-items-center justify-content-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #5a5; color: white; height: 38px; width: 38px; padding: 0; border-radius: 5px;">
                        <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">プロフィール編集</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main style="background-color: #e0e0e0; padding-top: 90px;">
    <div class="py-3">
        <div class="container py-4" style="background-color: #ffffff; max-width: 800px;">
            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
