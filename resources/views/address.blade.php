@extends('layouts.app')

@section('content')

<script src="{{ asset('js/address.js') }}"></script>

<style>
.loading-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-top-color: #007bff;
    animation: spin 0.8s linear infinite;
    margin-top: 0.5rem;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

</style>

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
                                <div class="form-group">
                                    <label for="province-select">استان</label>
                                    <select id="province-select" class="form-control province-select" name="province" required>
                                        <option value="">انتخاب استان</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->name }}">
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="city-div" class="form-group">
                                    <label for="city-select">شهر</label>
                                    <select id="city-select" class="form-control" name="city" required>
                                        <option value="">انتخاب شهر</option>
                                    </select>
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
