<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">

        {{-- Desktop Search --}}
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <form action="{{ route('search') }}" method="GET">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Search tours, bookings, users..." class="form-control" autocomplete="off"
                        minlength="1" />
                </div>
            </form>
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

            {{-- Mobile Search --}}
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <li>
                        <form action="{{ route('search') }}" method="GET"
                            class="navbar-left navbar-form nav-search px-2 py-1">
                            <div class="input-group">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..."
                                    class="form-control" autocomplete="off" minlength="2" />
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </li>

            {{-- User Dropdown --}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa fa-user-circle me-1"></i>
                    {{ Auth::user()->name ?? ''}}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    {{-- Profile --}}
                    {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fa fa-user me-2"></i> {{ __('Profile') }}
                    </a> --}}

                    <div class="dropdown-divider"></div>

                    {{-- Logout --}}
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out me-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

        </ul>
    </div>
</nav>
