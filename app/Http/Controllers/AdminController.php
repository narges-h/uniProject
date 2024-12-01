<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'کاربر با موفقیت حذف شد.');
        }

        return redirect()->route('admin.users')->with('error', 'کاربر یافت نشد.');
    }
}
