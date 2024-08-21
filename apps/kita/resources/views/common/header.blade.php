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
                    <!-- ログインしている場合にユーザー名を表示し、クリックでドロップダウンメニューを表示 -->
                    <li class="nav-item dropdown">
                        <a class="btn btn-sm btn-success" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8BC34A; border: 2px solid #8BC34A; border-radius: 10px; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;">
                            <i class="far fa-user-circle" style="font-size: 25px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                プロフィール編集
                            </a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownToggle = document.getElementById('navbarDropdown');
        var dropdownMenu = dropdownToggle.nextElementSibling;

        dropdownToggle.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownMenu.classList.toggle('show');
        });
    });
</script>
