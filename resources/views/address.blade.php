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
                                    <div class="form-group">
                                        <label for="province-select">استان</label>
                                        <select id="province-select" class="form-control" name="province_id" required>
                                            <option value="">انتخاب استان</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="city-select">شهر</label>
                                        <select id="city-select" class="form-control" name="city_id" required>
                                            <option value="">انتخاب شهر</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
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




<script>
    document.getElementById('province-select').addEventListener('change', function () {
        const provinceId = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set('province_id', provinceId);
        window.location.href = url.toString();
    });
</script>
