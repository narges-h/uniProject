<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart($id)
    {
        $book = Book::findOrFail($id);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = $cart->cartItems()->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $id,
                'quantity' => 1,
                'price' => $book->price,
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'کتاب به سبد خرید اضافه شد.');
    }

    public function showCart()
    {
        $cart = Cart::where('user_id', auth()->id())->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return view('cart', ['cartItems' => [], 'totalPrice' => 0]);
        }
        $totalPrice = $cart->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', [
            'cartItems' => $cart->cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }


    public function removeFromCart($id)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->cartItems()->where('id', $id)->delete();
        }

        return redirect()->route('cart.show')->with('success', 'محصول با موفقیت حذف شد.');
    }

    public function increaseQuantity($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $book = Book::find($cartItem->product_id);
        if ($book->stock > $cartItem->quantity) {
            $cartItem->quantity++;
            $cartItem->save();
        }

        $cart = Cart::where('user_id', auth()->id())->with('cartItems.product')->first();
        $total = $cart->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json(['newQuantity' => $cartItem->quantity, 'total' => number_format($total)]);
    }

    public function decreaseQuantity( $id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        }

        $cart = Cart::where('user_id', auth()->id())->with('cartItems.product')->first();
        $total = $cart->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json(['newQuantity' => $cartItem->quantity, 'total' => number_format($total)]);
    }
}
