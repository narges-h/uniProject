@extends('layouts.adminApp')

@section('title', 'مدیریت دسته‌بندی‌ها')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">دسته‌بندی‌ها</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover text-center" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>نام دسته‌بندی</th>
                <th>تعداد کتاب‌ها</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->books->count() }}</td> <!-- فرض کنید دسته‌بندی رابطه‌ای با کتاب‌ها دارد -->
                <td>
                    <a
                    {{-- href="{{ route('admin.editCategory', $category->id) }}" --}}
                        class="btn btn-primary btn-sm">ویرایش</a>
                    <form
                    {{-- action="{{ route('admin.deleteCategory', $category->id) }}" --}}
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
