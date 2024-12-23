<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/adminApp.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <nav>
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('img/logoGreen.svg') }}" alt="لوگوی سایت">
                <div class="logo-name">
                    <a href="{{ route('categories.index') }}"
                    class="text-decoration-none text-dark fw-bold siteName">برگستان</a>
                </div>

            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('add-book') ? 'active' : '' }}"
                            href="{{ route('add-book') }}">
                            <i class="fa fa-plus icon"></i>
                            افزودن محصول
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('admin.books') ? 'active' : '' }}"
                            href="{{ route('admin.books') }}">
                            <i class="fa fa-book icon"></i>
                            کتاب‌ها
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                            href="{{ route('admin.users') }}">
                            <i class="fa fa-users icon"></i>
                            مدیریت کاربران
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}"
                            href="{{ route('admin.categories') }}">
                            <i class="fa fa-list icon"></i>
                            مدیریت دسته‌بندی‌ها
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}"
                           href="{{ route('products.create') }}">
                            <i class="fa fa-plus icon"></i>
                            افزودن دسته‌بندی
                        </a>
                    </li>


                    <li class="list">
                        <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}"
                            href="{{ route('admin.orders') }}">
                            <i class="fa fa-shopping-cart icon"></i>
                            سفارشات
                        </a>
                    </li>
                </ul>

                <!-- بخش خروج -->
                <div class="logout-section">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button id="logout" type="submit" class="btn btn-danger w-100">خروج</button>
                    </form>
                </div>
            </div>

        </div>
    </nav>
    <script src="{{ asset('js/adminApp.js') }}"></script>


    <!-- Main Content -->
    <main class="content bg-light p-4 flex-grow-1">
        <div class="container">
            <nav class="breadcrumb bg-transparent px-0 mb-4">
                <a class="breadcrumb-item text-dark" href="{{ route('admin.books') }}">خانه</a>
                <span class="breadcrumb-item text-dark">@yield('page-title', 'عنوان صفحه')</span>
            </nav>
            @yield('content')

            @if(session('alertSuccess'))
            <script>
                Swal.fire({
                    title: "موفق",
                    text: "{{ session('alertSuccess') }}",
                    icon: "success"
                });
            </script>
        @endif

        @if(session('alertError'))
            <script>
                Swal.fire({
                    title: "خطا",
                    text: "{{ session('alertError') }}",
                    icon: "error"
                });
            </script>
        @endif
        </div>
    </main>
</body>

</html>
