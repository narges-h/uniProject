<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>@yield('title', 'Default Title')</title> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    @php
        $showHeader = $showHeader ?? true;
    @endphp
    @if (isset($showHeader) && $showHeader)
        <header>
            <div class="header-container">
                <div class="logo">
                <img src="{{ asset('img/logoGreen.svg') }}"class="img-fluid" />
                </div>
                <div class="buttons">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">خروج</button>
                    </form>


                    @if (isset($userType) && $userType == 'admin')
                        <form id="insert-form" action="{{ route('add-book') }}" method="GET" style="display: inline;">
                            <button type="submit" class="btn btn-primary">افزودن پست</button>
                        </form>
                    @endif
                </div>
            </div>
        </header>
    @endif

    <script src="{{ asset('js/main.js') }}"></script>
    <main class="container">
        @yield('content')
    </main>

    <footer>
        <!-- فوتر سایت -->
    </footer>
</body>
</html>


