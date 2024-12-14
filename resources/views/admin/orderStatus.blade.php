@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h2>مدیریت سفارشات</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>کاربر</th>
                <th>محصول</th>
                <th>تاریخ سفارش</th>
                <th>شهر</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->order->user->name }} {{ $item->order->user->family }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->order->order_date }}</td>
                <td>{{ $item->order->city }}</td>
                <td>
                    <span class="badge
                        {{ $item->order->status === 'pending' ? 'bg-warning' : '' }}
                        {{ $item->order->status === 'approved' ? 'bg-success' : '' }}
                        {{ $item->order->status === 'rejected' ? 'bg-danger' : '' }}">
                        {{ $item->order->status }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $item->order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select">
                            <option value="pending" {{ $item->order->status === 'pending' ? 'selected' : '' }}>در حال بررسی</option>
                            <option value="approved" {{ $item->order->status === 'approved' ? 'selected' : '' }}>تایید شده</option>
                            <option value="rejected" {{ $item->order->status === 'rejected' ? 'selected' : '' }}>رد شده</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
