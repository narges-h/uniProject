@extends('layouts.app')

@section('content')
    <div class="container mt-5" dir="rtl">
        <h2>سبد خرید</h2>
        <div class="row">
            @if (!empty($cartItems))
                <div class="col-md-8">
                    @foreach ($cartItems as $item)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $item->product->coveruri }}" class="img-fluid rounded-start"
                                        alt="{{ $item->product->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->product->title }}</h5>
                                        <p class="card-text">قیمت: {{ number_format($item->price) }} تومان</p>
                                        <p class="card-text">تعداد: {{ $item->quantity }}</p>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>فاکتور خرید </h5>
                            <p>مجموع: {{ number_format($totalPrice) }} تومان</p>
                            <a href="{{ route('checkout.address') }}" class="btn btn-success w-100">ادامه فرایند خرید</a>
                        </div>
                    </div>
                </div>
            @else
                <p>سبد خرید خالی است.</p>
            @endif
        </div>
    </div>
@endsection
