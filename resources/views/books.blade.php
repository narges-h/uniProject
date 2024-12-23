@extends('layouts.app')
@section('title', ' نمایش کتاب')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="main mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book->coveruri }}" class="img-fluid" alt="{{ $book->title }}" width="60%" height="80%">
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
                    @if (auth()->check())
                        @if($isInCart)
                            <form id="form" action="{{ route('cart.show') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn">نمایش سبد خرید</button>
                            </form>
                        @else
                            <form id="form" action="{{ route('cart.add', ['id' => $book->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn" onclick="showSuccess()">افزودن به سبد خرید</button>
                            </form>
                        @endif
                    @else
                        <button type="button" class="btn" onclick="showAlert()">افزودن به سبد خرید</button>
                    @endif
                @endif
            </div>
        </div>

        <div class="description">
            <h2>توضیحات</h2>
            <p>{{ $book->description }}</p>
        </div>

    </div>

    <script>
        function showAlert() {
            Swal.fire({
                title: "برای افزودن به سبد خرید لطفاً ابتدا وارد شوید",
                showCancelButton: true,
                confirmButtonText: "ورود",
                cancelButtonText: "لغو",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
        function showSuccess() {
            event.preventDefault();

            Swal.fire({
                    title: "موفق",
                    text: "محصول به سبد خرید شما اضافه شد",
                    icon: "success",
                    confirmButtonText: "نمایش سبد خرید",
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form').submit();
                }
            });
        }
    </script>


@endsection
