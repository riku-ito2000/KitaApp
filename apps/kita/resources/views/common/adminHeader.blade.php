<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Kita</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admin_users.index') }}">管理者管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">会員管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.article_tags.index') }}">タグ管理</a>
                </li>
            </ul>
            <form class="d-flex">
                <a href="{{ route('admin.logout') }}" class="btn btn-outline-light">ログアウト</a>
            </form>
        </div>
    </div>
</nav>
