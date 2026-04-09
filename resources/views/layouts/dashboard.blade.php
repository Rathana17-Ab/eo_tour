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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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
        /* tr:target td {
            background-color: #d1ecf1 !important;
            border-top: 2px solid #007bff !important;
            border-bottom: 2px solid #007bff !important;
            transition: all 0.3s ease;
        }

        tr:target td:first-child {
            border-left: 5px solid #007bff !important;
        } */



        .nav-item.active {
            background: #1e293b;
            border-left: 4px solid #3b82f6;
            border-radius: 6px;
        }

        .nav-item.active a {
            color: #fff !important;
            font-weight: bold;
        }

        .nav-item.active i {
            color: #3b82f6;
        }

        .nav-item.active {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
        }
    </style>

</head>
</head>

<body class="d-flex flex-column min-vh-100">

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
            <footer class="bg-dark text-white py-3 mt-auto">
                <div class="container text-center">
                    <p class="mb-0">&copy; 2026 EO Tour. All rights reserved.</p>
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
