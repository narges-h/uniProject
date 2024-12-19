@extends('layouts.adminApp')

@section('title', isset($category) ? 'ویرایش دسته‌بندی' : 'افزودن دسته‌بندی')
@section('page-title', isset($category) ? 'ویرایش دسته‌بندی' : 'افزودن دسته‌بندی')

@section('content')

    <link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header bg-white d-flex align-items-center gap-3">
                <h5 class="mb-0">{{ isset($category) ? 'ویرایش دسته‌بندی' : 'افزودن دسته‌بندی' }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ isset($category) ? route('admin.updateCategory', $category->id) : route('admin.storeCategory') }}"
                      method="POST" class="form">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="category_name" class="form-label">نام دسته‌بندی</label>
                        <input type="text" name="category_name" id="category_name" class="form-control"
                               value="{{ isset($category) ? $category->category_name : old('category_name') }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary">لغو</a>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($category) ? 'ویرایش' : 'افزودن' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
