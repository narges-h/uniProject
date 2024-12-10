@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/add-book.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <div dir="rtl">

        <div class="pageTitle">
            <h1>ویرایش پروفایل</h1>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="main">
            @csrf
            {{-- @method('PUT') --}}

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">نام:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="family" class="form-label">نام خانوادگی:</label>
                    <input type="text" class="form-control" id="family" name="family" value="{{ $user->family }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="mobile" class="form-label">شماره موبایل:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">تاریخ تولد:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="{{ $user->birthdate }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">ایمیل:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="col-md-6">
                    <label for="educationLevel" class="form-label">مدرک تحصیلی:</label>

                    <select id="educationLevel" name="educationLevel" class="form-control">
                        <option value="" disabled selected>مدرک تحصیلی</option>
                        <option value="دیپلم">دیپلم</option>
                        <option value="لیسانس">لیسانس</option>
                        <option value="فوق لیسانس">فوق لیسانس</option>
                        <option value="دکترا">دکترا</option>
                    </select>
                </div>
                <div class="col-12">
                    <input type="hidden" id="id" name="id" value="{{ $user->id }}" hidden>

                    <label for="avatar" class="form-label">تصویر پروفایل:</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" alt="profile image" height="100" class="mt-2">
                    @endif
                </div>
            </div>

            <div class="save">
                <button type="submit" class="btn btn-primary mt-3">ذخیره تغییرات</button>
            </div>
        </form>

        <div class="main mt-5">
            <h2 class="mb-4">تغییر رمز عبور</h2>
            <form action="{{ route('profile.changePassword') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">رمز عبور فعلی:</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">رمز عبور جدید:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">تکرار رمز عبور جدید:</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation" required>
                </div>

                <div class="save">
                    <button type="submit" class="btn btn-primary mt-3">ذخیره رمز عبور جدید</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/addBook.js') }}"></script>
@endsection
