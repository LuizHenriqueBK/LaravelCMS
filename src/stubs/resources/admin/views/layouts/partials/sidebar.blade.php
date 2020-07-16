<ul id="accordionSidebar" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <div class="text-white font-weight-bold mt-3 pl-3 sidebar-title">{{ Str::ucfirst(__('administrative')) }}</div>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->is(['admin/users', 'admin/users/*']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ Str::ucfirst(__('users')) }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is(['admin/roles', 'admin/roles/*']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.roles.index') }}">
            <i class="fas fa-fw fa-cubes"></i>
            <span>{{ Str::ucfirst(__('roles')) }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is(['admin/permissions', 'admin/permissions/*']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.permissions.index') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>{{ Str::ucfirst(__('permissions')) }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
