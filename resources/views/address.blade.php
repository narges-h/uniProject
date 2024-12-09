@extends('layouts.app')

@section('content')
    <div class="container mt-5" dir="rtl">
        <h2>تکمیل فرایند</h2>
        <div class="row">
            @if (!empty($cartItems))
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>ثبت اطلاعات آدرس</h5>
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="province" class="form-label">استان</label>
                                        <input type="text" class="form-control" id="province" name="province" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">شهر</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">آدرس</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postCode" class="form-label">کد پستی</label>
                                        <input type="text" class="form-control" id="postCode" name="postCode" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">ثبت سفارش</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>فاکتور خرید</h5>
                            <p>مجموع: {{ number_format($totalPrice) }} تومان</p>
                        </div>
                    </div>
                </div>
            @else
                <p>سبد خرید خالی است.</p>
            @endif
        </div>
    </div>
@endsection
