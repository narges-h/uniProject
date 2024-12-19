@extends('layouts.app')

@section('content')
    <div class="container mt-5" dir="rtl">
        <div class="alert alert-success">
            <h4>سفارش شما با موفقیت ثبت شد!</h4>
            <p>به زودی اطلاعات بیشتر به شما اطلاع داده خواهد شد.</p>
            <a href="{{ route('userOrders') }}" class="btn btn-primary">سفارشات</a>
        </div>
    </div>
@endsection
