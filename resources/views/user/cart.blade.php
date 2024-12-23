@extends('layouts.app')
@section('title', ' سبدخرید')

@section('content')

    <style>
        #delete-cart {
            margin-top: 16px;
        }

        /* تنظیمات عمومی دکمه‌ها */
        .custom-btn-decrease,
        .custom-btn-increase {
            width: 50px;
            height: 35px;
            border: 1px solid #ccc;
            /* بردر خاکستری */
            background-color: #f8f9fa;
            /* رنگ پس‌زمینه پیش‌فرض */
            color: #000;
            /* رنگ متن مشکی */
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.2s ease;
            border-radius: 8px;
            /* گوشه‌های کمی گرد برای ظاهر بهتر */
        }

        /* افکت هاور */
        .custom-btn-decrease:hover,
        .custom-btn-increase:hover {
            background-color: #e2e6ea;
            /* تغییر پس‌زمینه به خاکستری روشن‌تر هنگام هاور */
        }

        /* استایل عدد تعداد */
        .quantity-display {
            margin: 0 16px;
            font-size: 18px;
            font-weight: bold;
            color: #444;
            /* خاکستری تیره */
            text-align: center;
        }
    </style>

    <script src="{{ asset('js/cart.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <div class="container mt-5" dir="rtl">
        <h2>سبد خرید</h2>
        <div class="row">
            @if (!empty($cartItems))
                <div class="col-md-8">
                    @foreach ($cartItems as $item)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center">
                                    <a href="{{ route('books.details', $item->product_id) }}"><img
                                            src="{{ $item->product->coveruri }}" class="img-fluid rounded" width="100vh"
                                            height="150vh" style="max-height: 150px; object-fit: contain; margin-right:16px"
                                            alt="{{ $item->product->title }}">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->product->title }}</h5>
                                        <p class="card-text">قیمت: {{ number_format($item->price) }} تومان</p>

                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('increaseQuantity', $item->id) }}" method="POST"
                                                class="m-0 increase-form">
                                                @csrf
                                                <button id="increase" type="button" class="btn custom-btn-increase">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                            <span class="quantity-display">{{ $item->quantity }}</span>
                                            <form action="{{ route('decreaseQuantity', $item->id) }}" method="POST"
                                                class="m-0 decrease-form">
                                                @csrf
                                                <button id="decrease" type="button" class="btn custom-btn-decrease">
                                                    <i class="bi bi-dash-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <form id="delete-cart-form" action="{{ route('cart.remove', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            <button id="delete-cart" type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash" style="margin-left: 5px;"></i>حذف
                                            </button>
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
                            <h5>فاکتور خرید</h5>
                            <p id="totalPrice">مجموع قیمت کالاها: <strong>{{ number_format($totalPrice) }} تومان</strong>
                            </p>
                            <p>هزینه پست: <strong>{{ number_format($shippingCost) }} تومان</strong></p>
                            <hr>
                            <p id="finalPrice">مجموع کل: <strong>{{ number_format($finalPrice) }} تومان</strong></p>
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
