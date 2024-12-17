<style>
    .table tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
        /* سطرهای فرد */
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
        /* سطرهای زوج */
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<table class="table table-hover table-borderless align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>شماره سفارش</th>
            <th>کاربر</th>
            <th>تاریخ سفارش</th>
            <th>شهر مقصد</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $item)
            <tr onclick="showOrderProducts({{ $item->id }})" style="cursor: pointer;">
                <td>
                    <h6>{{ $item->id }}</h6>
                </td>
                <td>{{ $item->user->name }} {{ $item->user->family }}</td>
                <td>{{ \Carbon\Carbon::parse($item->order_date)->format('Y-m-d') }}</td>
                <td>{{ $item->city }}</td>
                <td>
                    <span
                        class="badge
                    {{ $item->status === 'pending' ? 'bg-warning' : '' }}
                    {{ $item->status === 'approved' ? 'bg-success' : '' }}
                    {{ $item->status === 'rejected' ? 'bg-danger' : '' }}">

                        @switch($item->status)
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
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $item->id) }}" method="POST" class="d-inline"
                        onclick="event.stopPropagation();">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select">
                            <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>در حال بررسی
                            </option>
                            <option value="approved" {{ $item->status === 'approved' ? 'selected' : '' }}>تایید شده
                            </option>
                            <option value="rejected" {{ $item->status === 'rejected' ? 'selected' : '' }}>رد شده
                            </option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">هیچ سفارشی یافت نشد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="orderProductsModal" tabindex="-1" aria-labelledby="orderProductsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderProductsModalLabel">محصولات سفارش</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <div class="text-start mb-2">
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
