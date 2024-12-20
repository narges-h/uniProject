<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/categories/category', compact('categories'));
    }


    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            session()->flash('alertSuccess', "دسته‌بندی با موفقیت حذف شد.");
            return redirect()->route('admin.categories');
        }

        session()->flash('alertError', "دسته‌بندی یافت نشد.");
        return redirect()->route('admin.categories')->with('error', 'دسته‌بندی یافت نشد.');
    }

    public function create()
    {
       
        return view('admin.categories.category-form'); // فرم افزودن
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.category-form', compact('category')); // ویرایش
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی با موفقیت افزوده شد.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }
}
