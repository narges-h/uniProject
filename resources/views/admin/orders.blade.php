@extends('layouts.adminApp')

@section('title', 'مدیریت سفارشات')
@section('page-title', 'سفارشات')

@section('content')
    <div class="container-fluid mt-4">
        <h2 class="mb-4">مدیریت سفارشات</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->order->user->name }}</td>
                            <td>{{ $item->order->user->family }}</td>
                            <td>{{ $item->book->title }}</td>
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
@endsection
