<!DOCTYPE html>
<html lang="en"  dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد ادمین</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar text-white" id="sidebar" style="background-color: #a1c65d;">
            <h2 class="text-center py-3">پنل ادمین</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('add-book') }}">افزودن محصول</a>
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
        <div class="content p-4" id="content">
            <h1 class="mb-4">کتاب ها</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{$book->coveruri}}" alt="book Image" class="img-thumbnail" style="width: 80px;"></td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            <a href="{{ route('update-book', ['id' => $book->id]) }}" class="btn btn-primary btn-sm">ویرایش کتاب</a>
                            <form id="delete-form" action="{{ route('delete-book', ['id' => $book->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button id="delete" type="submit" class="btn btn-danger btn-sm">حذف کتاب</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(session('alertSuccess'))
    <script>
        Swal.fire({
            title: "موفق",
            text: "{{ session('message') }}",
            icon: "success"
        });
    </script>
@endif
</body>


</html>
