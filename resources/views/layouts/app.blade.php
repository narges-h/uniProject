<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>@yield('title', 'Default Title')</title> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    @php
        $showHeader = $showHeader ?? true;
    @endphp
    @if (isset($showHeader) && $showHeader)
        <header>
            <div class="header-container bg-light p-3 d-flex justify-content-between align-items-center">
                <!-- Logo and Categories Link -->
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/logoGreen.svg') }}" class="img-fluid me-3" alt="Logo" style="height: 50px;">
                    <a href="{{ route('categories.index') }}" class="text-decoration-none text-dark fw-bold">برگستان</a>
                </div>

                <!-- Search Box -->
                {{-- <div class="search-box d-flex align-items-center">
                    <input type="text" class="form-control" placeholder="جستجو">
                    <button class="btn btn-outline-success ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                </div> --}}
                <div class="search-box d-flex align-items-center mb-4">
                    <form action="{{ route('searchBooksCategories') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" class="form-control" placeholder="جستجو..." required>
                        <button type="submit" class="btn btn-outline-success ms-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>


                <!-- User Actions -->
                <div class="user-actions d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success ms-3">ورود / ثبت‌نام</a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">اطلاعات کاربری</a></li>
                                <li><a class="dropdown-item"
                                    {{-- href="{{ route('cart') }}" --}}
                                     >سبد خرید</a></li>
                                <li><a class="dropdown-item"
                                      {{-- href="{{ route('orders') }}" --}}
                                      >سفارشات</a></li>
                                <li>
                                    <form id="logout-form"action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button id="logout" type="submit" class="dropdown-item text-danger">خروج از حساب</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
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


