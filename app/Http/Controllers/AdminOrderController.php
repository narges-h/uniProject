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
        $orderItems = Order::with([
            'user:id,name,family',
        ])->get();

        return view('admin.orders', compact('orderItems'));
    }



    public function getOrderItems($id)
    {
        $items =  Order::with([
            'orderItems',
            'orderItems.book',
            'user:id,name,family',
        ])->where('id', $id)->get();

        return response()->json($items);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $order = Order::find($id);
        $order->update(['status' => $request->status]);

        return redirect()->to('/admin/orderStatus')->with('success', 'وضعیت سفارش با موفقیت به‌روزرسانی شد.');
    }
}
