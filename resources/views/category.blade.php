@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">

<div class="container mt-5">
    <!-- عنوان دسته‌بندی -->
    <h2 class="text-center mb-4 category-title">{{ $categoryName }}</h2>

    <!-- گرید کارت‌های کتاب -->
    <div class="book-grid">
        @foreach ($books as $book)
            <div id="book-card" data-book-id="{{ $book->id }}">
                <img src="{{ $book->coveruri }}" alt="{{ $book->title }}">
                <h5 class="card-title">{{ $book->title }}</h5>
                <div class="card-body">
                    <p class="card-text">{{ $book->author }}</p>
                    <p class="card-text">{{ number_format($book->price) }} تومان</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
