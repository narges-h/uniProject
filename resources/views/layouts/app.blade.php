<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>@yield('title', 'Default Title')</title> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


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
                    <img src="{{ asset('img/logoGreen.svg') }}" class="img-fluid me-3" alt="Logo"
                        style="height: 50px;">
                    <a href="{{ route('categories.index') }}"
                        class="text-decoration-none text-dark fw-bold siteName">برگستان</a>
                </div>
                <form method="GET" action="{{ route('searchBooksCategories') }}" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" id="search-input" name="query" class="form-control border-0 shadow-sm"
                            placeholder="جستجو براساس عنوان یا نویسنده..." value="{{ request()->query('query') }}"
                            required>
                        <button class="btn btn-primary">
                            <span>جستجو</span>
                        </button>

                    </div>
                </form>

                <!-- User Actions -->
                <div class="user-actions d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success ms-3">ورود / ثبت‌نام</a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="userMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name . ' ' . Auth::user()->family }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">اطلاعات کاربری</a></li>
                                <li><a class="dropdown-item" href="{{ route('cart.show') }}">سبد خرید</a></li>
                                <li><a class="dropdown-item" href="{{ route('userOrders') }}">سفارشات</a></li>
                                <form id="logout-form"action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button id="logout" type="submit" class="dropdown-item text-danger">خروج از
                                        حساب</button>
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
    <main class="container" style="min-height:35.6%">
        @yield('content')


        @if (session('alertSuccess'))
            <script>
                Swal.fire({
                    title: "موفق",
                    text: "{{ session('alertSuccess') }}",
                    icon: "success"
                });
            </script>
        @endif

        @if (session('alertError'))
            <script>
                Swal.fire({
                    title: "خطا",
                    text: "{{ session('alertError') }}",
                    icon: "error"
                });
            </script>
        @endif

    </main>

    <footer class="footer bg-dark text-light py-3 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- لوگوی سایت -->
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <img src="{{ asset('img/logoGreen.svg') }}" alt="لوگوی سایت" class="footer-logo">
                    <h5 class="mt-2">برگستان</h5>
                </div>

                <!-- لینک‌های مفید -->
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><a href=# class="text-light text-decoration-none">صفحه اصلی</a></li>
                        <li><a href=# class="text-light text-decoration-none">درباره ما</a></li>
                        <li><a href=# class="text-light text-decoration-none">تماس با ما</a>
                        </li>
                        <li><a href=# class="text-light text-decoration-none">قوانین و مقررات</a>
                        </li>
                    </ul>
                </div>

                <!-- اطلاعات تماس -->
                <div class="col-md-4 text-center text-md-end">
                    <p class="mb-1">تماس: <a href="tel:+989123456789"
                            class="text-light text-decoration-none">09012259354</a></p>
                    <p class="mb-1">ایمیل: <a href="bargestan-man@gmail.com"
                            class="text-light text-decoration-none">bargestan-man@gmail.com</a></p>
                    <p class="mb-0">آدرس: گرگان، خیابان کاشانی</p>
                </div>
            </div>
            <hr class="border-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 برگستان | تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>

</body>

</html>
