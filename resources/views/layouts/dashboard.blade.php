<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    {{-- ================================================
         FONTS — loads Google font + Font Awesome icons
         Must load before CSS so icons render correctly
    ================================================ --}}
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"]
            }
        });
    </script>

    {{-- ================================================
         MAIN CSS FILES
         bootstrap.min.css  — Bootstrap 5 grid & components
         plugins.min.css    — third-party plugin styles
         kaiadmin.min.css   — theme styles (sidebar, navbar, cards)
    ================================================ --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    
    <style>
        tr:target td {
            background-color: #d1ecf1 !important;
            border-top: 2px solid #007bff !important;
            border-bottom: 2px solid #007bff !important;
            transition: all 0.3s ease;
        }

        tr:target td:first-child {
            border-left: 5px solid #007bff !important;
        }
    </style>
</head>
</head>

<body>

    {{-- ================================================
         WRAPPER — wraps sidebar + main panel together
         keeps them side by side on the screen
    ================================================ --}}
    <div class="wrapper">

        {{-- ============================================
             SIDEBAR — left navigation panel
             pulled from layouts/side.blade.php
             contains: logo, nav links (Tour, Booking)
        ============================================ --}}
        @include('layouts.side')

        {{-- ============================================
             MAIN PANEL — everything to the right of sidebar
             contains: header navbar, page content, footer
        ============================================ --}}
        <div class="main-panel">

            {{-- ========================================
                 HEADER / NAVBAR — top bar
                 pulled from layouts/nav.blade.php
                 contains: search, messages, notifications
            ======================================== --}}
            <div class="main-header">
                @include('layouts.nav')
            </div>

            {{-- ========================================
                 PAGE CONTENT — changes per page
                 each child view fills this section using:
                 @section('content') ... @endsection
            ======================================== --}}
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            {{-- ========================================
                 FOOTER — bottom of every page
                 stays the same across all pages
            ======================================== --}}
            <footer class="footer">
                <div class="container-fluid text-center">
                    © 2026 Tour Booking System
                </div>
            </footer>

        </div>
        {{-- END MAIN PANEL --}}

    </div>
    {{-- END WRAPPER --}}

    {{-- ================================================
         JAVASCRIPT FILES — loaded at bottom for performance
         ORDER MATTERS: jQuery → Popper → Bootstrap → plugins → theme
         jquery        — required by scrollbar & kaiadmin
         popper        — required by Bootstrap dropdowns/tooltips
         bootstrap     — Bootstrap 5 JS (modals, collapse, dropdowns)
         jquery-scrollbar — smooth scrollbar inside sidebar
         kaiadmin      — theme JS (sidebar toggle, nav behavior)
    ================================================ --}}
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

</body>

</html>
