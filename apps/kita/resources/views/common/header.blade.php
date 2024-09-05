<header>
    <nav class="navbar navbar-expand-md" style="height: 70px; background-color: #ffffff;">
        <div class="container" style="max-width: 800px;">
            <div class="row w-100 align-items-center">
                <!-- Kitaボタン -->
                <div class="col-auto">
                    <a class="navbar-brand kita-brand btn rounded-pill px-4 py-2 fs-3 text-white" href="{{ url('/') }}" style="background-color: #8BC34A;">
                        {{ config('app.name', 'Kita') }}
                    </a>
                </div>

                <!-- 検索フォーム -->
                <div class="col">
                    <form class="d-flex search-form" action="{{ route('articles.index') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control search-input" type="search" name="search" placeholder="Search for something" aria-label="Search" value="{{ request('search') }}" style="background-color: #ffffff;">
                            <!-- 検索ボタン -->
                            <button class="btn search-btn" type="submit" style="background-color: #5a5; color: white; border: none;">
                                <span class="d-none d-md-inline">検索</span> <!-- 大きな画面で表示 -->
                                <i class="fas fa-search d-md-none"></i> <!-- 小さな画面でアイコン表示 -->
                            </button>
                        </div>
                    </form>
                </div>
                <!-- 記事作成ボタン -->
                @auth
                <div class="col-auto">
                        <a class="btn btn-sm btn-success create-article-btn" href="{{ route('articles.create') }}" style="background-color: white; border: 2px solid #5a5; color: black; padding: 8px 20px;">
                            <span class="d-none d-md-inline">記事を作成する</span> <!-- 大きな画面で表示 -->
                            <i class="fas fa-edit d-md-none"></i> <!-- 小さな画面でアイコン表示 -->
                        </a>
                </div>
                @endauth
                <!-- プロフィールアイコンまたはログインアイコン -->
                <div class="col-auto">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <!-- ログインしていない場合に表示されるアイコン -->
                            <li class="nav-item dropdown">
                                <a class="btn btn-sm btn-success p-0 d-flex justify-content-center align-items-center" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8BC34A; border: 2px solid #8BC34A; border-radius: 10px; width: 40px; height: 40px;">
                                    <i class="fas fa-sign-in-alt" style="font-size: 25px;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                                    <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('新規会員登録') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
                                </ul>
                            </li>
                        @else
                            <!-- ログインしている場合、クリックでドロップダウンメニューを表示 -->
                            <li class="nav-item dropdown">
                                <a class="btn btn-sm btn-success p-0 d-flex justify-content-center align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8BC34A; border: 2px solid #8BC34A; border-radius: 10px; width: 40px; height: 40px;">
                                    <i class="far fa-user-circle" style="font-size: 25px;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">プロフィール編集</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">{{ __('ログアウト') }}</a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
