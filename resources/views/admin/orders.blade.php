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
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->family }}</td>
                            <td>
                                @if ($order->cart && $order->cart->cartItems)
                                    {{ $order->cart->cartItems->pluck('product.title')->join(', ') }}
                                @else
                                    بدون محصول
                                @endif
                            </td>

                            <td>
                                @if ($order->cart && $order->cart->items)
                                    {{ $order->cart->items->pluck('quantity')->sum() }}
                                @else
                                    0
                                @endif
                            </td>

                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                            <td>{{ $order->city }}</td>
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
