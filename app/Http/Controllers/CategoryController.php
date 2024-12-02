<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/category', compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create(['name' => $request->name]);

        session()->flash('alertSuccess', "دسته‌بندی با موفقیت افزوده شد.");
        return redirect()->route('admin.categories');
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
    }
