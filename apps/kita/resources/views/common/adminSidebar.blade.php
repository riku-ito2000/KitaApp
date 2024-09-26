<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- ブランドロゴ -->
    <a class="brand-link" style="text-decoration: none;">
        <img src="{{ asset('image/k-logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Kita</span>
    </a>

    <!-- サイドバー -->
    <div class="sidebar" style="height: auto;">
        <!-- サイドバーメニュー -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- 管理者管理 -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            管理者管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>一覧・検索</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_users.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>新規登録</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 会員管理 -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>会員管理</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
