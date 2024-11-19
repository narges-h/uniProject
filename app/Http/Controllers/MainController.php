<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $book = Book::findOrFail($id); // اگر کتاب وجود نداشته باشد، 404 می‌دهد.
        return view('books', compact('book'));
    }


}
