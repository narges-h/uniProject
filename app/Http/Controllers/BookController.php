<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{

    public function create()
    {
        $categories = Category::all();

        $title = "افزودن کتاب";

        return view('addBook', compact('categories'))->with('title', $title)->with('showHeader' , false) ;
    }
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'stock' => 'required|integer|min:0',
            'publishDate' => 'required|date',
            'number_of_page' => 'required|integer|min:1',
            'coveruri' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'translator_name' => 'nullable|string|max:255',
            'lang' => 'required|string',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $coverImagePath = $request->file('coveruri')->store('cover_images', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'rating' => $request->rating,
            'stock' => $request->stock,
            'publishDate' => $request->publishDate,
            'number_of_page' => $request->number_of_page,
            'coveruri' => $coverImagePath,
            'translator_name' => $request->translator_name,
            'lang' => $request->lang,
        ]);

        return redirect()->to('/categories')->with([
            'message' => 'کتاب با موفقیت اضافه شد.'
        ]);

    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $title = "ویرایش کتاب";

        return view('addBook', compact('categories', 'book'))->with('title', $title)->with('showHeader', false);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'publisher' => 'string|max:255',
            'category_id' => 'integer|exists:categories,id',
            'price' => 'numeric',
            'description' => 'string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'stock' => 'integer|min:0',
            'publishDate' => 'date',
            'number_of_page' => 'integer|min:1',
            'coveruri' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',  // تغییر به nullable
            'translator_name' => 'nullable|string|max:255',
            'lang' => 'string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = Book::findOrFail($id); // دریافت کتاب بر اساس ID

        // اگر تصویری بارگذاری شده باشد، آن را ذخیره کن
        if ($request->hasFile('coveruri')) {
            $coverImagePath = $request->file('coveruri')->store('cover_images', 'public');
            $book->coveruri = $coverImagePath; // به‌روزرسانی مسیر تصویر
        }

        // به‌روزرسانی سایر فیلدها
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->category_id = $request->category_id;
        $book->price = $request->price;
        $book->description = $request->description;
        $book->rating = $request->rating;
        $book->stock = $request->stock;
        $book->publishDate = $request->publishDate;
        $book->number_of_page = $request->number_of_page;
        $book->translator_name = $request->translator_name;
        $book->lang = $request->lang;

        $book->save(); // ذخیره به روزرسانی‌ها

        return redirect()->route('books.details', $id)->with('message', 'کتاب با موفقیت به‌روزرسانی شد.');
    }


    public function delete($id)
    {

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->to('/categories')->with([
            'message' => 'کتاب با موفقیت حذف شد.'
        ]);
    }
}

