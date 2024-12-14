<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function showAddressForm(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cartItems = $cart->cartItems()->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $client = new Client();

        // دریافت استان‌ها
        $response = $client->get('https://iran-locations-api.ir/api/v1/fa/states');
        $provinces = json_decode($response->getBody()->getContents());


        $cities = [];
        return view('address', compact('provinces', 'cities', 'cartItems', 'totalPrice'));
    }
    public function getCities($province)
    {
        $cities = [];
        $client = new Client();

        $url = "https://iran-locations-api.ir/api/v1/fa/cities?state={$province}";

        $responseCities = $client->get($url);
        $responseBody = json_decode($responseCities->getBody()->getContents(), true);

        $cities = $responseBody[0]['cities'];

        return response()->json(['cities' => $cities]);
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

            $book = $cartItem->product;
            if ($book->stock >= $cartItem->quantity) {
                $book->stock -= $cartItem->quantity;
                $book->save();
            } else {
                return redirect()->back()->with('error', 'موجودی کافی برای برخی کتاب‌ها وجود ندارد.');
            }
        }
        $cart->cartItems()->delete();

        return redirect()->route('orders.success')->with('success', 'سفارش شما با موفقیت ثبت شد.');
    }
    public function userOrders()
    {
        $orders = Order::with(['orderItems.book'])
            ->where('user_id', auth()->id())
            ->get();

        return view('order', compact('orders'));
    }

}
