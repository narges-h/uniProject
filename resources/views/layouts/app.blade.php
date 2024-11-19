<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <header>
        <!-- هدر سایت -->
    </header>

    <script src="{{ asset('js/main.js') }}"></script>
    <main class="container">
        @yield('content')
    </main>

    <footer>
        <!-- فوتر سایت -->
    </footer>
</body>
</html>


