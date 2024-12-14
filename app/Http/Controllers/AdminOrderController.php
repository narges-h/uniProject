<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{


    // نمایش سفارشات برای ادمین
    public function index()
    {
        $orderItems = OrderItem::with([
            'book:id,title',
            'order:id,user_id,order_date,city,status',
            'order.user:id,name,family',
        ])->get();

        return view('admin.orders', compact('orderItems'));
    }

    public function orderStatus()
    {
        $orderItems = OrderItem::with([
            'book:id,title',
            'order:id,user_id,order_date,city,status',
            'order.user:id,name,family',
        ])->get();

        return view('admin.orderStatus', compact('orderItems'));
    }


     public function updateStatus(Request $request, Order $order)
     {
         $request->validate([
             'status' => 'required|in:pending,approved,rejected',
         ]);

         $order->update(['status' => $request->status]);

         return redirect()->to('/admin/orderStatus')->with('success', 'وضعیت سفارش با موفقیت به‌روزرسانی شد.');
     }
}
