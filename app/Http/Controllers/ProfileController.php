<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'))->with('showHeader' , false);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('profile', compact('user'))->with('showHeader' , false);
    }

    public function update(Request $request)
    {

        $user = User::find($request->id);

        // اعتبارسنجی داده‌های ورودی
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email' ,
            'mobile' => 'nullable|digits:11',
            'family' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'educationLevel' => 'nullable|string|max:255',
        ]);


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPath = public_path('avatars');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            $avatarPath = url('avatars/' . $fileName);
            $user->avatar = $avatarPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->family = $request->family;
        $user->birthdate = $request->birthdate;
        $user->educationLevel = $request->educationLevel;

        $user->save();

        session()->flash('alertSuccess',  "اطلاعات شما با موفقیت به‌روزرسانی شد.");
        if(Auth::user()->user_type == 'admin')
            return redirect()->to('/admin/users');
        return redirect()->to('categories');


    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('alertError',  "رمز عبور فعلی اشتباه است.");
            return redirect()->back();
        }

        // به‌روزرسانی رمز عبور
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('alertSuccess',  "رمز عبور با موفقیت تغییر کرد.");
        return redirect()->to('/profile');
    }

}
