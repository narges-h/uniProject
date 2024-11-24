@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @foreach ($categories as $category)
            <div class="category-item mb-5">
                <div class="category-section">
                <h3 class="text-center category-title">{{ $category->category_name }}</h3>
                <div class="text-center mt-3">
                    <a href="{{ route('books.byCategory', ['id' => $category->id]) }}" class="btn btn-primary">
                        مشاهده همه
                    </a>
                </div>
                </div>

                <!-- گرید کارت‌های کتاب -->
                <div class="book-grid">
                    @foreach ($category->books->take(6) as $book)
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
                

            </div>
    @endforeach
</div>
@endsection
