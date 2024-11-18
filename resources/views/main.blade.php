@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<div class="container mt-5">
    @foreach ($categories as $category)
    <div class="category-section mb-5">
        <!-- عنوان دسته‌بندی -->
        <h2 class="text-center category-title">{{ $category->name }}</h2>

        <!-- گرید کارت‌های کتاب -->
        <div class="book-grid">
            @foreach ($category->books as $book)
            <div class="book-card">
                <img src="{{ $book->coveruri }}" alt="{{ $book->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">نویسنده: {{ $book->author }}</p>
                    <p class="card-text">قیمت: {{ number_format($book->price) }} تومان</p>
                    <a href="{{ route('books.details', ['id' => $book->id]) }}" class="btn">مشاهده</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('books.byCategory', ['id' => $category->id]) }}" class="btn btn-primary">
                مشاهده همه کتاب‌های این دسته‌بندی
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
