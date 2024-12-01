<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class BookController extends Controller
{

    public function create()
    {
        $categories = Category::all();

        $title = "افزودن کتاب";

        // متغیر بوک برای ارور نبودن بوک در بلید که ولیو در اینپوت هارو نشون میده و خالیه
        $book = new Book();

        return view('addBook', compact('categories' , 'book'))->with('title', $title)->with('isUpdate', false)->with('showHeader' , false) ;

    }
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'publishDate' => 'required|date',
            'coveruri' => 'required|file|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('coveruri');
        $destinationPath = public_path('cover_images');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        $coverImagePath = url('cover_images/' . $fileName);


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

        session()->flash('alertSuccess', "کتاب با موفقیت اضافه شد.");

        return redirect()->to('/admin');

    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $title = "ویرایش کتاب";

        return view('addBook', compact('categories', 'book'))->with('title', $title)->with('isUpdate', true)->with('showHeader', false);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'publishDate' => 'date',
            'coveruri' => 'nullable|file|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = Book::findOrFail($id);


        if ($request->hasFile('coveruri')) {
            $file = $request->file('coveruri');

        $destinationPath = public_path('cover_images');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        $coverImagePath = url('cover_images/' . $fileName);

            $book->coveruri = $coverImagePath; // به‌روزرسانی مسیر تصویر
        }

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

        session()->flash('alert', true);
        return redirect()->to('admin');
    }


    public function delete($id)
    {

        $book = Book::findOrFail($id);
        $book->delete();


        session()->flash('alertSuccess', "کتاب با موفقیت حذف شد.");
        return redirect()->to('/admin');
    }

    public function index() {
        $books = Book::all();

        if(Auth::check()){
            return view('admin/admin', compact('books'));
        }
        return redirect()->to('/login');


    }

}

