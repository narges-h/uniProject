@extends('layouts.app')

@section('content')
    <div class="container mt-5" dir="rtl">
        <div class="alert alert-success">
            <h4>سفارش شما با موفقیت ثبت شد!</h4>
            <p>به زودی اطلاعات بیشتر به شما اطلاع داده خواهد شد.</p>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        </div>
    </div>
@endsection
