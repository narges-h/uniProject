<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showAddressForm()
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cartItems = $cart->cartItems()->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('address', compact('cartItems', 'totalPrice'));
    }
    public function storeOrder(Request $request)
    {
        $request->validate([
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'postCode' => 'required|string|max:10',
        ]);

        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cartItems = $cart->cartItems()->with('product')->get();

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'cart_id' => $cart->id,
            'order_date' => now(),
            'total_amount' => $totalAmount,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'postCode' => $request->postCode,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }

        $cart->cartItems()->delete();

        return redirect()->route('orders.success')->with('success', 'سفارش شما با موفقیت ثبت شد.');
    }
    // public function storeOrder(Request $request)
    // {
    //     $request->validate([
    //         'province' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'address' => 'required|string',
    //         'postCode' => 'required|string|max:10',
    //     ]);

    //     $cart = Cart::where('user_id', auth()->id())->firstOrFail();
    //     $cartItems = $cart->cartItems;
    //     $totalAmount = $cartItems->sum(function ($item) {
    //         return $item->price * $item->quantity;
    //     });
    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'cart_id' => $cart->id,
    //         'order_date' => now(),
    //         'total_amount' => $totalAmount,
    //         'province' => $request->province,
    //         'city' => $request->city,
    //         'address' => $request->address,
    //         'postCode' => $request->postCode,
    //     ]);

    //     $cart->cartItems()->delete();

    //     return redirect()->route('orders.success')->with('success', 'سفارش شما با موفقیت ثبت شد.');
    // }

    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return view('order', compact('orders'));
    }

    public function index()
    {
        $orderItems = OrderItem::with([
            'book:id,title',
            'order:id,user_id,order_date,city',
            'order.user:id,name,family',
        ])->get();

        // dd($orderItems->first()->order->user);
        return view('admin.orders', compact('orderItems'));
    }
}
