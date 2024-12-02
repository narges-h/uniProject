@extends('layouts.adminApp')

@section('title', 'مدیریت کاربران')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">کاربران</h1>

    <!-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif -->

    <table class="table table-hover text-center" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th> دسترسی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>تصویر پروفایل</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->user_type }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->family }}</td>
                <td>
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail" style="width: 50px;">
                    @else
                        <span>ندارد</span>
                    @endif
                </td>
                <td>
                    <form id="delete-user-form" action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="delete-user" type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('js/users.js') }}"></script>
@endsection
