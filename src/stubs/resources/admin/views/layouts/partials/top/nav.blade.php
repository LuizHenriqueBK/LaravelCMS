<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    @include('Admin::layouts.partials.top.search')

    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        @include('Admin::layouts.partials.top.searchDropDown')

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a href="#" id="userDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ Auth::user()->avatar->url }}">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>

                <a href="{{ route('admin.logs') }}" class="dropdown-item">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logs
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ Str::ucfirst(__('logout')) }}
                </a>
            </div>
        </li>
    </ul>
</nav>
