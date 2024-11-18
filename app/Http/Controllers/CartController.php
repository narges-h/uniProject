<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{

    // public function addToCart($id, Request $request)
    // {
    //     $book = Book::findOrFail($id);

    //     // ذخیره اطلاعات سبد خرید در سشن
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             'title' => $book->title,
    //             'price' => $book->price,
    //             'quantity' => 1,
    //             'coveruri' => $book->coveruri,
    //         ];
    //     }

    //     session()->put('cart', $cart);

    //     return redirect()->back()->with('success', 'کتاب به سبد خرید افزوده شد.');
    // }

}
