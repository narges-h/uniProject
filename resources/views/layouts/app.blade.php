<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- هدر سایت -->
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <!-- فوتر سایت -->
    </footer>
</body>
</html>
