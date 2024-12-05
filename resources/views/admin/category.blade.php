@extends('layouts.adminApp')

@section('title', 'مدیریت دسته‌بندی‌ها')
@section('page-title', 'مدیریت دسته‌بندی‌ها')

@section('content')

    <link href="{{ asset('css/admin/category.css') }}" rel="stylesheet">


    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header bg-white d-flex align-items-center gap-3">

                <h5 class="mb-0">دسته‌بندی‌ها</h5>

                <form method="GET" action="#" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control border-0 shadow-sm"
                            placeholder="جستجو براساس دسته بندی   ..." value="{{ request()->query('query') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

            </div>


            <div class="card-body p-0">
                <table class="table table-hover table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>نام دسته‌بندی</th>
                            <th>تعداد کتاب‌ها</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->books->count() }}</td>
                                <!-- فرض کنید دسته‌بندی رابطه‌ای با کتاب‌ها دارد -->

                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <a href=" route('admin.editCategory', $category->id) " class="btn btn-edit btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST"
                                            class="d-inline" id="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete" type="submit" class="btn btn-delete btn-sm">
                                                <i class="fas fa-trash-alt"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/category.js') }}"></script>
@endsection
