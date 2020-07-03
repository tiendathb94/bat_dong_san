<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <link rel="stylesheet" href="{{ asset('css/app.css') . '?m=' . filemtime('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('themify-icons/themify-icons.css') . '?m=' . filemtime('themify-icons/themify-icons.css') }}">
    <link
        rel="stylesheet"
        href="{{ asset('css/partials/navbar.css') . '?m=' . filemtime('css/partials/navbar.css') }}">
    @stack('styles')
</head>

<body>
    <div class="grid">
        @include('default.partials.header')

        <!-- CONTENT -->
        <div class="page-main-container">
            @yield('content')
        </div>

        @include('default.partials.footer')
    </div>
    <script src="{{ asset('js/app.js') . '?m=' . filemtime('js/app.js') }}"></script>
    @stack('scripts')
    <script>
        var width = $(window).width();
        var clickMenuParent = [];
        if (width <= 1024) {
            $(document).on('click', '.menu-parent', function (e) {
                if (clickMenuParent[$(this).data('key')]) {
                    clickMenuParent[$(this).data('key')] = 0;
                } else {
                    clickMenuParent[$(this).data('key')] = 1;
                    e.preventDefault();
                }
            })

            $('.navbar-header-menu-items').removeClass('top-0 left-100').addClass('left-0 top-100');
        }
    </script>
</body>
</html>
