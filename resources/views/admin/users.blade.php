@extends('layouts.adminApp')

@section('title', 'مدیریت کاربران')
@section('page-title', 'مدیریت کاربران')

@section('content')

    <link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">
    <script src="{{ asset('js/users.js') }}"></script>


    <!-- Users Table -->
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded">

            <div class="card-header bg-white d-flex align-items-center gap-3">
                <h5 class="mb-0">لیست کاربران</h5>
                <div class="flex-grow-1">
                        <div class="input-group">
                            <input id="search-input" type="text" name="query" class="form-control border-0 shadow-sm"
                                placeholder="جستجو براساس نام یا شماره تلفن...">
                            <button onclick="searchData()" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
            </div>

            <div class="card-body p-0">
                <table id="table" class="table table-hover table-borderless align-middle mb-0">
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
                                <td><h6>{{ $user->user_type }}</h6></td>
                                <td class="user-name"><h6>{{ $user->name }}</h6></td>
                                <td class="user-family"><h6>{{ $user->family }}</h6></td>
                                <td class="user-phone"><h6>{{ $user->mobile }}</h6></td>
                                <td>


                                @if($user->avatar)
                                    <img src="{{ asset($user->avatar) }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('avatars/default.jpg') }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <a href="{{route('profile.edit', ['id' => $user->id])}}" class="btn btn-edit btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <form id="delete-user-form" action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button id ="delete-user" type="submit" class="btn btn-delete btn-sm">
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
        <script>
            function searchData(){
                const query = document.getElementById('search-input').value;
                const rows = document.querySelectorAll('#table tbody tr'); // سطرهای جدول

                rows.forEach(row => {
                    const name = row.querySelector('.user-name').textContent.toLowerCase();
                    const family = row.querySelector('.user-family').textContent.toLowerCase();
                    const phone = row.querySelector('.user-phone').textContent.toLowerCase();

                    if (name.includes(query) || family.includes(query) || phone.includes(query)) {
                        row.style.display = ''; // نمایش سطر
                    } else {
                        row.style.display = 'none'; // مخفی کردن سطر
                    }
            });
        }
        </script>
    </div>

@endsection
