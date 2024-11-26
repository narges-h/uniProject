<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        $userType = Auth::user()->user_type;

        return view('main', compact('categories'))->with('userType' , $userType) ;;
    }


    public function showBookDetails($id)
    {
        $book = Book::findOrFail($id); // اگر کتاب وجود نداشته باشد، 404 می‌دهد.
        return view('books', compact('book'));
    }


}
