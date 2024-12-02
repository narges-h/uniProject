<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar text-white" style="width: 250px; background-color: #a1c65d; min-height: 100vh; position: fixed;">
            <h2 class="text-center py-3">پنل ادمین</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('add-book') }}">افزودن محصول</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-white" href="{{ route('admin.books') }}">کتاب‌ها</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-white" href="{{ route('admin.users') }}">مدیریت کاربران</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-white" href="{{ route('admin.categories') }}">مدیریت دسته‌بندی‌ها</a>
                </li>
                <li class="nav-item mt-3">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">خروج</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content p-4" style="margin-left: 250px; width: 100%;">
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
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
