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
        // اعتبارسنجی داده‌های ارسالی از فرم
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // فرض کنید جدولی با نام categories دارید
            'price' => 'required|numeric',
            'description' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'stock' => 'required|integer|min:0',
            'publishDate' => 'required|date',
            'number_of_page' => 'required|integer|min:1',
            'coveruri' => 'nullable|url',
            'translator_name' => 'nullable|string|max:255',
            'lang' => 'required|string', // فرض می‌کنیم این فیلد زبان کتاب است.
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ذخیره اطلاعات کتاب در پایگاه داده
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'rating' => $request->rating,
            'stock' => $request->stock,
            'publishDate' => $request->publishDate,
            'number_of_page' => $request->number_of_page,
            'coveruri' => $request->coveruri,
            'translator_name' => $request->translator_name,
            'lagn' => $request->lagn,
        ]);

        return redirect()->to('/categories')->with([
            'message' => 'کتاب با موفقیت اضافه شد.'
        ]);

    }
}

