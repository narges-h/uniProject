@extends('layouts.adminApp')

@section('title', 'لیست کتاب‌ها')

@section('page-title', 'لیست کتاب‌ها')

@section('content')

    <link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Cards Section -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">تعداد کل کتاب‌ها</h6>
                    <h3 class="card-text">{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">تعداد موجودی کتاب‌ها</h6>
                    <h3 class="card-text">{{ $totalStock }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">کتاب‌های ناموجود</h6>
                    <h3 class="card-text">{{ $outOfStockBooks }}</h3>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">لیست کتاب‌ها</h5>
        <div>
            <a href="{{ route('admin.books.sort', ['order' => 'desc']) }}" class="btn btn-outline-primary me-2">
                جدیدترین
            </a>
            <a href="{{ route('admin.books.sort', ['order' => 'asc']) }}" class="btn btn-outline-secondary">
                قدیمی‌ترین
            </a>
        </div>
    </div> --}}



    <!-- Books Table -->
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">

            <div class="card-header bg-white d-flex align-items-center gap-3">
                <h5 class="mb-0">لیست کتاب‌ها</h5>
                <div>
                    <a href="{{ route('admin.books.sort', ['order' => 'desc']) }}" class="btn btn-outline-primary me-2">
                        جدیدترین
                    </a>
                    <a href="{{ route('admin.books.sort', ['order' => 'asc']) }}" class="btn btn-outline-secondary">
                        قدیمی‌ترین
                    </a>
                </div>
                <div class="flex-grow-1">
                    <div class="input-group">
                        <input id="search-input" type="text" name="query" class="form-control border-0 shadow-sm"
                            placeholder="جستجو براساس عنوان یا نویسنده...">
                        <button onclick="searchBooks()" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>


            <link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

            <div class="card-body p-0">
            <table id ="table"class="table table-hover table-borderless align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>نویسنده</th>
                        <th>قیمت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $book->coveruri }}" alt="تصویر کتاب" class="img-thumbnail"
                                    style="width: 55px; height: 80px; object-fit: cover;">
                            </td>
                            <td class="book-title"><h6>{{ $book->title }}</h6></td>
                            <td class="book-author">{{ $book->author }}</td>
                            <td>{{ number_format($book->price) }} تومان</td>
                            <td>
                                <a href="{{ route('update-book', ['id' => $book->id]) }}" class="btn btn-edit btn-sm">
                                    <i class="fas fa-edit"></i> ویرایش
                                </a>
                                <form id="delete-form" action="{{ route('delete-book', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" type="submit" class="btn btn-delete btn-sm">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        </div>

    <script>
        function searchBooks(){
        const query = document.getElementById('search-input').value;
        const rows = document.querySelectorAll('#table tbody tr'); // سطرهای جدول

        rows.forEach(row => {
            const title = row.querySelector('.book-title').textContent.toLowerCase();
            const author = row.querySelector('.book-author').textContent.toLowerCase();

            if (title.includes(query) || author.includes(query)) {
                row.style.display = ''; // نمایش سطر
            } else {
                row.style.display = 'none'; // مخفی کردن سطر
            }
        });
    }

    </script>
    </div>



@endsection
