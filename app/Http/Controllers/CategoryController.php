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

        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی با موفقیت افزوده شد.');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
        }

        return redirect()->route('admin.categories')->with('error', 'دسته‌بندی یافت نشد.');
    }
    }
