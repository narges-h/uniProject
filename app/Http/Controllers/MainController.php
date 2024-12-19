<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function showBooksByCategory($id)
    {
        $categoryName = Category::find($id)->category_name;
        $books = Book::where('category_id', $id)->get();

        return view('category', compact('categoryName', 'books'));
    }

    public function showCategoriesWithBooks()
    {
        $categories = Category::has('books')->with(['books'])->get();
        return view('main', compact('categories'));
    }


    public function showBookDetails($id)
    {
        $book = Book::findOrFail($id);

        $cart = Cart::where('user_id', auth()->id())->with('cartItems.product')->first();

        $isInCart = false;

        if($cart != null){
            $items = $cart->cartItems;
            foreach ($items as $item) {
                if ($item->product_id == $id) {
                    $isInCart = true;
                    break;
                }
            }
        }
        // $userType = Auth::user()->user_type;
        return view('books', compact('book', 'isInCart'));
        // ->with('userType' , $userType) ;
    }
}
