@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<div class="container mt-5">
    <h2 class="text-center mb-4">نتایج جستجو برای "{{ $query }}"</h2>

    <!-- نتایج کتاب‌ها -->
    @if($books->isNotEmpty())
        <h3 class="mb-3">کتاب‌ها</h3>
        <div class="book-grid">
            @foreach($books as $book)
                <div id="book-card" data-book-id="{{ $book->id }}">
                    <img class="cover" src="{{ $book->coveruri }}" alt="{{ $book->title }}">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $book->author }}</p>
                        <h5 class="card-text">{{ number_format($book->price) }} تومان</h5>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">کتابی یافت نشد.</p>
    @endif

    <!-- نتایج دسته‌بندی‌ها -->
    @if($categories->isNotEmpty())
        <h3 class="mt-5 mb-3">دسته‌بندی‌ها</h3>
        <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item">
                    <a href="{{ route('books.byCategory', ['id' => $category->id]) }}">
                        {{ $category->category_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center text-muted">دسته‌بندی‌ای یافت نشد.</p>
    @endif
</div>
@endsection
