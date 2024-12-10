@extends('layouts.app')

@section('content')
    <div class="container mt-5" dir="rtl">
        <h2>لیست سفارشات</h2>
        @if ($orders->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>شماره سفارش</th>
                            <th>تاریخ سفارش</th>
                            <th>مبلغ کل</th>
                            <th>استان</th>
                            <th>شهر</th>
                            <th>آدرس</th>
                            <th>کد پستی</th>
                            <th>جزئیات کالا</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                                <td>{{ number_format($order->total_amount) }} تومان</td>
                                <td>{{ $order->province }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->postCode }}</td>
                                <td>
                                    @if ($order->orderItems->isNotEmpty())
                                        <ul>
                                            @foreach ($order->orderItems as $item)
                                                <li>
                                                    {{ $item->book->title }} - تعداد: {{ $item->quantity }} - قیمت:
                                                    {{ number_format($item->price) }} تومان
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        بدون کالا
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>شما هنوز سفارشی ثبت نکرده‌اید.</p>
        @endif
    </div>
@endsection
