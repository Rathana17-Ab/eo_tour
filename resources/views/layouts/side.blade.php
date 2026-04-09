    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">

                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/kaiadmin/eot-logo.png') }}" alt="EOT Logo" class="navbar-brand"
                        height="50" width="auto" />
                </a>

                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>

            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                        </>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    @can('tour.viewer')
                        <li class="nav-item {{ request()->routeIs('tour.*') ? 'active' : '' }}">
                            <a href="{{ route('tour.index') }}">
                                <i class="fas fa-compass"></i>
                                <p>Tour</p>
                                <span class="caret"></span>
                            </a>
                            </>
                        @endcan

                        @can('booking.viewer')
                        <li class="nav-item {{ request()->routeIs('booking.*') ? 'active' : '' }}">
                            <a href="{{ route('booking.index') }}">
                                <i class="fas fa-calendar-check"></i>
                                <p>Booking</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                </ul>
                            </div>
                        </li>
                    @endcan
                    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}"> <a
                            href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Users</p>
                            <span class="caret"></span>
                        </a></li>

                    <li class="nav-item {{ request()->routeIs('role.*') ? 'active' : '' }}"> <a
                            href="{{ route('role.index') }}">
                            <i class="bi bi-person-badge"></i>
                            <p>Role</p>
                            <span class="caret"></span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('permissions.*') ? 'active' : '' }}"> <a
                            href="{{ route('permissions.index') }}">
                            <i class="bi bi-shield-lock"></i>
                            <p>Permission</p>
                            <span class="caret"></span>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
