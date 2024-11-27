@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book->coveruri }}" class="img-fluid" alt="{{ $book->title }}">
            </div>

            <div class="col-md-8">
                <h1>{{ $book->title }}</h1>

                <div class="book-info">
                    <p><strong>نویسنده:</strong> {{ $book->author }}</p>
                    <p><strong>مترجم:</strong> {{ $book->translator_name ?? 'ندارد' }}</p>
                    <p><strong>دسته‌بندی:</strong> {{ $book->category->category_name }}</p>
                    <p><strong>تاریخ انتشار:</strong> {{ $book->publishDate }}</p>
                    <p><strong>تعداد صفحات:</strong> {{ $book->number_of_page }}</p>
                    <p><strong>زبان:</strong> {{ $book->lang }}</p>
                    <p><strong>امتیاز:</strong> {{ $book->rating }} / 5</p>
                    <p>
                        <strong>وضعیت موجودی:</strong>
                        @if ($book->stock > 0)
                            <span class="text-success">موجود</span>
                        @else
                            <span class="text-danger">ناموجود</span>
                        @endif
                    </p>
                    <p><strong>قیمت:</strong> {{ number_format($book->price) }} تومان</p>
                </div>

                @if ($book->stock > 0)
                    <form action="{{ route('cart.add', ['id' => $book->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">افزودن به سبد خرید</button>
                    </form>
                @endif

                @if (isset($userType) && $userType == 'admin')
                    <form id="update-form" action="{{ route('update-book', ['id' => $book->id]) }}" method="GET"
                        style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">ویرایش کتاب</button>
                    </form>
                @endif

                @if (isset($userType) && $userType == 'admin')
                    <form id="delete-form" action="{{ route('delete-book', ['id' => $book->id]) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">حذف کتاب</button>
                    </form>
                @endif

            </div>
        </div>

        <div class="description">
            <h2>توضیحات</h2>
            <p>{{ $book->description }}</p>
        </div>
    </div>
@endsection
