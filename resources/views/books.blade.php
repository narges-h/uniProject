@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/books.css') }}">

<div class="container mt-5">
    <div class="row">
        <!-- تصویر و اطلاعات کلی -->
        <div class="col-md-4">
            <img src="{{ $book->coveruri }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
        </div>
        <div class="col-md-8">
            <h1 class="mb-3">{{ $book->title }}</h1>
            <p><strong>نویسنده:</strong> {{ $book->author }}</p>
            <p><strong>مترجم:</strong> {{ $book->translator_name ?? 'ندارد' }}</p>
            <p><strong>دسته‌بندی:</strong> {{ $book->category->name }}</p>
            <p><strong>تاریخ انتشار:</strong> {{ $book->publishDate }}</p>
            <p><strong>تعداد صفحات:</strong> {{ $book->number_of_page }}</p>
            <p><strong>زبان:</strong> {{ $book->lagn }}</p>
            <p><strong>امتیاز:</strong> {{ $book->rating }} / 5</p>
            <p><strong>وضعیت موجودی:</strong>
                @if ($book->stock > 0)
                    <span class="text-success">موجود</span>
                @else
                    <span class="text-danger">ناموجود</span>
                @endif
            </p>
            <p><strong>قیمت:</strong> {{ number_format($book->price) }} تومان</p>
        </div>
    </div>

    <!-- توضیحات کتاب -->
    <div class="mt-5">
        <h2>توضیحات</h2>
        <p>{{ $book->description }}</p>
    </div>

    <!-- افزودن به سبد خرید -->
    <div class="mt-4">
        <form action="{{ route('cart.add', ['id' => $book->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">افزودن به سبد خرید</button>
        </form>
    </div>
</div>
@endsection
