@extends('layouts.adminApp')

@section('title', 'مدیریت سفارشات')
@section('page-title', 'سفارشات')

@section('content')
<link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-white d-flex align-items-center gap-3">
            <h5 class="mb-0">لیست سفارشات</h5>
             <form method="GET" action="#" class="flex-grow-1">
                <div class="input-group">
                <input id="search-input" type="text" name="query" class="form-control border-0 shadow-sm"
                        placeholder="جستجو براساس شماره سفارش..." value="{{ request()->query('query') }}">
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
                    <th>شماره سفارش</th>
                    <th>نام کاربر</th>
                    <th>نام خانوادگی</th>
                    <th>عنوان کتاب</th>
                    <th>تعداد</th>
                    <th>تاریخ سفارش</th>
                    <th>شهر مقصد</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orderItems as $item)
                    <tr>
                        <td><h6>{{ $item->order->id }}</h6></td>
                        <td>{{ $item->order->user->name }}</td>
                        <td>{{ $item->order->user->family }}</td>
                        <td><h6>{{ $item->book->title }}</h6></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->order->order_date)->format('Y-m-d') }}</td>
                        <td>{{ $item->order->city }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">هیچ سفارشی یافت نشد.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
