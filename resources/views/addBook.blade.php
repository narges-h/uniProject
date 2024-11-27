@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-book.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <div class="pageTitle">
        <h1>{{ $title }}</h1>
    </div>

    <form
        @if (isset($book)) action="{{ route('update' , ['id' => $book->id]) }}"  method="PUT"
        @else action="{{ route('insert') }}"  method="POST"
        @endif

        class="container">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label">عنوان:</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{$book->title}}" required>
            </div>
            <div class="col-md-6">
                <label for="author" class="form-label">نویسنده:</label>
                <input type="text" class="form-control" id="author" name="author"
                    value="{{$book->author }}" required>
            </div>
            <div class="col-md-6">
                <label for="category_id" class="form-label">دسته بندی:</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">قیمت:</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="{{ $book->price}}" required>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">توضیحات:</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{$book->description }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="rating" class="form-label">امتیاز:</label>
                <input type="number" class="form-control" id="rating" name="rating"
                    value="{{$book->rating}}" min="0" max="5" step="0.1">
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">موجودی:</label>
                <input type="number" class="form-control" id="stock" name="stock"
                    value="{{$book->stock}}" min="0" required>
            </div>
            <div class="col-md-6">
                <label for="publishDate" class="form-label">تاریخ انتشار:</label>
                <input type="date" class="form-control" id="publishDate" name="publishDate"
                    value="{{$book->publishDate}}" required>
            </div>
            <div class="col-md-6">
                <label for="number_of_page" class="form-label">تعداد صفحات:</label>
                <input type="number" class="form-control" id="number_of_page" name="number_of_page"
                    value="{{$book->number_of_page}}" min="1" required>
            </div>
            {{-- <div class="col-12">
            <label for="coveruri" class="form-label">آدرس تصویر جلد:</label>
            <input type="url" class="form-control" id="coveruri" name="coveruri" required>
        </div> --}}
            <div class="col-12">
                <label for="coveruri" class="form-label">آپلود تصویر جلد:</label>
                <input type="file" class="form-control" id="coveruri" name="coveruri" accept="image/*">
                <!-- تصویر فعلی اگر وجود داشته باشد -->
                @if ($book->coveruri)
                    <img src="{{ asset('storage/' . $book->coveruri) }}" alt="Cover image" height="100">
                @endif
            </div>
            <div class="col-md-6">
                <label for="translator_name" class="form-label">نام مترجم:</label>
                <input type="text" class="form-control" id="translator_name" name="translator_name"
                    value="{{$book->translator_name}}" required>
            </div>
            <div class="col-md-6">
                <label for="lang" class="form-label">زبان:</label>
                <select class="form-select" id="lang" name="lang">
                    @foreach (['Fa', 'En'] as $lang)
                        <option value="{{ $lang }}" {{ $lang == $book->lang ? 'selected' : '' }}>
                            {{ $lang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="publisher" class="form-label">ناشر:</label>
                <input type="text" class="form-control" id="publisher" name="publisher"
                    value="{{$book->publisher}}" required>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="save">
                <button type="submit" class="btn btn-primary mt-3">ذخیره</button>
            </div>
        </div>
    </form>
@endsection
