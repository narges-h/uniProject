@extends('layouts.adminApp')

@section('title', 'مدیریت کاربران')
@section('page-title', 'مدیریت کاربران')

@section('content')

    <link href="{{ asset('css/admin/users.css') }}" rel="stylesheet">


    <!-- Users Table -->
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">

            <div class="card-header bg-white d-flex align-items-center gap-3">
                <h5 class="mb-0">لیست کاربران</h5>
                <form method="GET" action="#" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control border-0 shadow-sm"
                            placeholder="جستجو براساس نام یا شماره تلفن..." value="{{ request()->query('query') }}">
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
                            <th>دسترسی</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره تلفن</th>
                            <th>تصویر پروفایل</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->user_type }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->family }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="Avatar" class="rounded-circle"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">ندارد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <a href="#" class="btn btn-edit btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-sm">
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

    <script src="{{ asset('js/users.js') }}"></script>
@endsection
