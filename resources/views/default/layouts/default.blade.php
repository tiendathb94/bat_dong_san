<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <link rel="stylesheet" href="{{ asset('css/app.css') . '?m=' . filemtime('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('themify-icons/themify-icons.css') . '?m=' . filemtime('themify-icons/themify-icons.css') }}">
    @stack('styles')
</head>

<body>
<div class="grid">
    @include('default.partials.header')

    <!-- CONTENT -->
    <div class="container page-main-container">
        @yield('content')
    </div>

    @include('default.partials.footer')
</div>

<script src="{{ asset('js/app.js') . '?m=' . filemtime('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
