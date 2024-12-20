@extends('layouts.adminApp')

@section('title', isset($book) ? 'ویرایش کتاب' : 'افزودن کتاب')
@section('page-title', isset($book) ? 'ویرایش کتاب' : 'افزودن کتاب')

@section('content')

<link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-white d-flex align-items-center gap-3">
            <h5 class="mb-0">{{ isset($book) ? 'ویرایش کتاب' : 'افزودن کتاب' }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ isset($book) ? route('update', ['id' => $book->id]) : route('insert') }}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                @if(isset($book))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">عنوان:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ isset($book) ? $book->title : old('title') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="author" class="form-label">نویسنده:</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ isset($book) ? $book->author : old('author') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="category_id" class="form-label">دسته‌بندی:</label>
                        <select name="category_id" id="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">قیمت:</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ isset($book) ? $book->price : old('price') }}" required>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">توضیحات:</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ isset($book) ? $book->description : old('description') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="rating" class="form-label">امتیاز:</label>
                        <input type="number" name="rating" id="rating" class="form-control" min="0" max="5" step="0.1" value="{{ isset($book) ? $book->rating : old('rating') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="stock" class="form-label">موجودی:</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{ isset($book) ? $book->stock : old('stock') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="publishDate" class="form-label">تاریخ انتشار:</label>
                        <input type="date" name="publishDate" id="publishDate" class="form-control" value="{{ isset($book) ? $book->publishDate : old('publishDate') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="number_of_page" class="form-label">تعداد صفحات:</label>
                        <input type="number" name="number_of_page" id="number_of_page" class="form-control" min="1" value="{{ isset($book) ? $book->number_of_page : old('number_of_page') }}" required>
                    </div>

                    <div class="col-12">
                        <label for="coveruri" class="form-label">آپلود تصویر جلد:</label>
                        <input type="file" name="coveruri" id="coveruri" class="form-control" accept="image/*">
                        @if(isset($book) && $book->coveruri)
                            <img src="{{ $book->coveruri }}" alt="Cover image" height="100" class="mt-2">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="translator_name" class="form-label">نام مترجم:</label>
                        <input type="text" name="translator_name" id="translator_name" class="form-control" value="{{ isset($book) ? $book->translator_name : old('translator_name') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="lang" class="form-label">زبان:</label>
                        <select name="lang" id="lang" class="form-select">
                            @foreach (['Fa', 'En'] as $lang)
                                <option value="{{ $lang }}" {{ isset($book) && $book->lang == $lang ? 'selected' : '' }}>{{ $lang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="publisher" class="form-label">ناشر:</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ isset($book) ? $book->publisher : old('publisher') }}" required>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.categories') }}" class="btn btn-secondary">لغو</a>
                    <button type="submit" class="btn btn-primary">{{ isset($book) ? 'ویرایش' : 'افزودن' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
