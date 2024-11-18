@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">

<div class="container mt-5">
    <!-- عنوان دسته‌بندی -->
    <h2 class="text-center mb-4 category-title">{{ $categoryName }}</h2>

    <!-- گرید کارت‌های کتاب -->
    <div class="book-grid">
        @foreach ($books as $book)
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
</div>

@endsection
