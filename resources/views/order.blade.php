@extends('layouts.app')

@section('content')

<link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

<div class="container-fluid" dir="rtl">
    <div class="">
        <div class="card-header bg-white d-flex align-items-center gap-3">
            <h3 class="mt-5">لیست سفارشات</h3>
        </div>
        <div class="card shadow-sm rounded">
        @if ($orders->isNotEmpty())
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="table-light">
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
                @foreach($orders as $order)
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
        @else
            <p>شما هنوز سفارشی ثبت نکرده‌اید.</p>
        @endif
        </div>
    </div>
</div>

@endsection
