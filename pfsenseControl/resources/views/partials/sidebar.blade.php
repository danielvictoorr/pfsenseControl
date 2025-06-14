<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PfControl</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('firewall') }}" class="nav-link">
                        <i class="fas fa-shield-alt"></i>
                        <p class="ml-3">Firewall Rules</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('servers') }}" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p> Firewall Servers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p> Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
