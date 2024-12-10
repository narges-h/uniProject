@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <div class="main">
    @foreach ($categories as $category)
        <div class="category-item mb-5">
            <div class="category-section">
                <h5 class="category-title">{{ $category->category_name }}</h5>
                <a href="{{ route('books.byCategory', ['id' => $category->id]) }}" class="btn btn-primary">
                    مشاهده همه
                </a>
            </div>


            <!-- گرید کارت‌های کتاب -->
            <div class="book-grid">
                @foreach ($category->books->take(6) as $book)
                    <div id="book-card" data-book-id="{{ $book->id }}">
                        <img class="cover" src="{{ $book->coveruri }}" alt="{{ $book->title }}">

                        <h6 class="card-title">{{ $book->title }}</h6>
                        <div class="card-body">
                            <p class="card-text">{{ $book->author }}</p>
                            <h6 class="card-text">{{ number_format($book->price) }} تومان</h6>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    @endforeach
    </div>
</div>
@endsection
