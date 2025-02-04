<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('outros-links')
</head>
<body>
    <div class="container">
        @yield('main')
        @include('layouts.footer')
    </div>
</body>
</html>
