@extends('layouts.app')

@section('content')

<link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">

<div class="container mt-5" dir="rtl">
    <div class="">
        <div class="card-header bg-white d-flex align-items-center gap-3">
            <h3>لیست سفارشات</h3>
        </div>
        <div class="card shadow-sm rounded mt-5">
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
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                <tr onclick="showOrderProducts({{ $order->id }})">
                                <td>{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                                <td>{{ number_format($order->total_amount) }} تومان</td>
                                <td>{{ $order->province }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->postCode }}</td>
                                <td>
                <span class="badge
                    {{ $order->status === 'pending' ? 'bg-warning' : '' }}
                    {{ $order->status === 'approved' ? 'bg-success' : '' }}
                    {{ $order->status === 'rejected' ? 'bg-danger' : '' }}">

                    @switch($order->status)

                        @case('pending')
                        در حال بررسی
                                 @break

                        @case('approved')
                            تایید شده
                        @break
                        @case('rejected')
                            رد شده
                        @break
                    @endswitch

                </span>
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


<!-- Modal -->
<div class="modal fade" id="orderProductsModal" tabindex="-1" aria-labelledby="orderProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" width="100%" dir="rtl">
                <h5 class="modal-title" id="orderProductsModalLabel">محصولات سفارش</h5>
                <button type="button" class="" style="align-items:center"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderProductsContent">
                <div class="text-center">در حال بارگذاری...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>




<script>
    function showOrderProducts(orderId) {
    // نمایش مدال
    const modal = new bootstrap.Modal(document.getElementById('orderProductsModal'));
    modal.show();

    // تنظیم محتوای پیش‌فرض
    document.getElementById('orderProductsContent').innerHTML = '<div class="text-center">در حال بارگذاری...</div>';

    // درخواست AJAX
    fetch(`/admin/order/${orderId}/items`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) throw new Error('خطا در دریافت اطلاعات');
            return response.json();
        })
        .then(result => {
            let data = result[0];
            if (!data.order_items || data.order_items.length === 0) {
                document.getElementById('orderProductsContent').innerHTML =
                    '<div class="alert alert-warning">هیچ محصولی در این سفارش وجود ندارد.</div>';
                return;
            }


            let content = `<ul class="list-group">`;
data.order_items.forEach(item => {
    content += `
        <li class="list-group-item">
            <div class="mb-2  text-end">
                <strong>${item.book.title}</strong>
            </div>
            <div class="d-flex justify-content-between">
                <small>تعداد: ${item.quantity}</small>
                <small>قیمت: ${Number(item.price).toLocaleString()} تومان</small>
            </div>
        </li>`;
});
content += `</ul>`;

content += `
    <div class="mt-3 text-center text-dark">
        <strong>هزینه کل:</strong>
        <span>${Number(data.total_amount).toLocaleString()} تومان</span>
    </div>`;


            // قرار دادن محتوا در مدال
            document.getElementById('orderProductsContent').innerHTML = content;
        })
        .catch(error => {
            document.getElementById('orderProductsContent').innerHTML =
                `<div class="alert alert-danger">خطا در دریافت اطلاعات: ${error.message}</div>`;
        });
}


</script>

@endsection
