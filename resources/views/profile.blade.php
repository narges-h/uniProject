@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">ویرایش پروفایل</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}

        <div class="row">
            <!-- Personal Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">نام</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" >
                </div>

                <div class="mb-3">
                    <label for="family" class="form-label">نام خانوادگی</label>
                    <input type="text" id="family" name="family" class="form-control" value="{{ $user->family }}">
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">شماره موبایل</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $user->mobile }}">
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">تاریخ تولد</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ $user->birthdate }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">ایمیل</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" >
                </div>

            </div>
        </div>

        <!-- Avatar -->
        <div class="mb-3">
            <label for="avatar" class="form-label">تصویر پروفایل</label>
            <input type="file" id="avatar" name="avatar" class="form-control">
            @if($user->avatar)
                <img src="{{$user->avatar }}" alt="profile image" height="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
    </form>


</div>

<!-- Change Password Form -->
<div class="container mt-5">
    <h2 class="mb-4">تغییر رمز عبور</h2>
    <form action="{{ route('profile.changePassword') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">رمز عبور فعلی</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">رمز عبور جدید</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">تکرار رمز عبور جدید</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">ذخیره رمز عبور جدید</button>
    </form>
</div>

@endsection
