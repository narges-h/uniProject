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
            session()->flash('alertSuccess', "کاربر با موفقیت حذف شد.");
            return redirect()->route('admin.users');
        }

        session()->flash('alertError', "کاربر یافت نشد.");
        return redirect()->route('admin.users');
    }

}
