@extends('layouts.adminApp')

@section('title', 'مدیریت سفارشات')
@section('page-title', 'سفارشات')

@section('content')

<link href="{{ asset('css/admin/admin-list.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<style>

.nav-tabs .nav-link.active {
    background-color: #2a623e; /* رنگ پس‌زمینه تب فعال */
    color: #ffffff;           /* رنگ متن تب فعال */
    border-radius: 5px;       /* ایجاد گوشه‌های گرد */
}
</style>

<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-white d-flex align-items-center gap-3">
            <h5 class="mb-0">وضعیت سفارشات</h5>
            <form method="GET" action="#" class="flex-grow-1">
                {{-- <div class="input-group">
                    <input id="search-input" type="text" name="query" class="form-control border-0 shadow-sm"
                        placeholder="جستجو براساس شماره سفارش..." value="{{ request()->query('query') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div> --}}
            </form>
        </div>

        <div class="card-body p-0">

        <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="orderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-orders-tab" data-bs-toggle="tab" data-bs-target="#all-orders" type="button" role="tab" aria-controls="all-orders" aria-selected="true">همه سفارشات</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-orders-tab" data-bs-toggle="tab" data-bs-target="#pending-orders" type="button" role="tab" aria-controls="pending-orders" aria-selected="false">در حال بررسی</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-orders-tab" data-bs-toggle="tab" data-bs-target="#approved-orders" type="button" role="tab" aria-controls="approved-orders" aria-selected="false">تایید شده</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rejected-orders-tab" data-bs-toggle="tab" data-bs-target="#rejected-orders" type="button" role="tab" aria-controls="rejected-orders" aria-selected="false">رد شده</button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content mt-4" id="orderTabsContent">
        <!-- All Orders Tab -->
        <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
            @include('admin.orders.table', ['orders' => $orderItems])
        </div>

        <!-- Pending Orders Tab -->
        <div class="tab-pane fade" id="pending-orders" role="tabpanel" aria-labelledby="pending-orders-tab">
            @include('admin.orders.table', ['orders' => $orderItems->filter(fn($item) => $item->status === 'pending')])
        </div>

        <!-- approved Orders Tab -->
        <div class="tab-pane fade" id="approved-orders" role="tabpanel" aria-labelledby="approved-orders-tab">
            @include('admin.orders.table', ['orders' => $orderItems->filter(fn($item) => $item->status === 'approved')])
        </div>
        <!-- Rejected Orders Tab -->
        <div class="tab-pane fade" id="rejected-orders" role="tabpanel" aria-labelledby="rejected-orders-tab">
            @include('admin.orders.table', ['orders' => $orderItems->filter(fn($item) => $item->status === 'rejected')])
        </div>
    </div>
        </div>
    </div>
</div>

@endsection
