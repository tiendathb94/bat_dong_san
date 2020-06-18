<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bất động sản</title>
    @include('client.master.css')

    @stack('css')
</head>
<body>

    <header>
        @include('client.master.main_menu')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('client.master.footer')
    </footer>

    @include('client.master.js')
    @stack('js')

</body>
</html>