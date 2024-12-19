<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;
use Illuminate\View\Component;

class AuthController extends Controller
{


    public function sendOtpPage()
    {
        if(Auth::check()){
            return redirect()->to('/categories');
        }
        return view('auth/login');
    }

    public function signup()
    {
        if(Auth::check()){
            return redirect()->to('/categories');
        }
        return view('auth/signup');

    }

    // public function sendOtp($phoneNumbers)
    // {
    //     $otp = rand(100000, 999999);

    //     Otp::create([
    //         'phone' => $phoneNumbers,
    //         'otp' => $otp,
    //     ]);

    //     try {
    //         $client = new Client();
    //         $response = $client->request('GET', 'https://api.kavenegar.com/v1/704865776F4C376665393662587063636D7630524B4132574C59586D783155455450495757556D715649553D/verify/lookup.json', [
    //             'query' => [
    //                 'receptor' => $phoneNumbers,
    //                 'token' => $otp,
    //                 'token2' => 'homeenger',
    //                 'template' => 'homeengerverify'
    //             ]
    //         ]);

    //         $responseBody = json_decode($response->getBody(), true);

    //         if ($responseBody['return']['status'] == 200) {
    //             // انتقال به صفحه OTP با استفاده از redirect
    //             return redirect()->to('/otp')->with('phoneNumbers', $phoneNumbers);
    //         } else {

    //             return back()->with('error', 'خطا در ارسال کد تایید.');
    //         }
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'خطا در ارسال کد تایید: ' . $e->getMessage());
    //     }
    // }

    public function sendOtp($phoneNumbers)
    {
        $otp = rand(100000, 999999);

        Otp::create([
            'phone' => $phoneNumbers,
            'otp' => $otp,
        ]);
        Log::info($otp);
        return redirect()->to('otp')->with('phoneNumbers', $phoneNumbers);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phoneNumbers' => 'required|numeric|digits:11',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('mobile', $request->phoneNumbers)->first();
        if (!$user) {
            return back()->withErrors(['کاربر با این شماره یافت نشد.'])->withInput();
        }

        $data = ['mobile' => $request->phoneNumbers, 'password' => $request->password];
        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            session(['user_name' => Auth::user()->name . ' ' . Auth::user()->family]);

            // بررسی نوع کاربر
            if (Auth::user()->user_type === 'admin') {
                return redirect()->to('/admin');
            }
            return redirect()->to('/categories');
        } else {
            return back()->withErrors(['اطلاعات نادرست است.'])->withInput();
        }
    }


    public function userSignup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'phoneNumbers' => 'required|numeric|digits:11',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'educationLevel' => 'required|string|in:دیپلم,لیسانس,فوق لیسانس,دکترا',
            'gender' => 'required|string|in:زن,مرد',
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }
        $userExists = User::where('mobile', $request->phoneNumbers)->exists();

        if ($userExists) {
            return back()->withErrors(['کاربر با این شماره ثبت نام کرده است.'])->withInput();
        }

        session([
            'user_signup_data' => $request->only(['name', 'family', 'phoneNumbers', 'password', 'educationLevel', 'gender']),
            'user_name' => $request->name . ' ' . $request->family,
            'phoneNumbers' => $request->phoneNumbers
        ]);
        return $this->sendOtp($request->phoneNumbers);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phoneNumbers' => 'required|numeric|digits:11',
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $otpRecord = Otp::where('phone', $request->phoneNumbers)
            ->where('otp', $request->otp)
            ->first();
        if (!$otpRecord) {

            return back()->withErrors(['کد تایید وارد شده نادرست است.'])->withInput();
        }
        $userData = session('user_signup_data');

        if ($userData && $userData['phoneNumbers'] === $request->phoneNumbers) {
            // ذخیره کاربر در دیتابیس
            $user = User::create([
                'name' => $userData['name'],
                'family' => $userData['family'],
                'mobile' => $userData['phoneNumbers'],
                'password' => bcrypt($userData['password']),
                'educationLevel' => $userData['educationLevel'],
                'gender' => $userData['gender'],
                'is_verified' => true,
            ]);

            // حذف رکورد OTP و اطلاعات سشن
            $otpRecord->delete();
            session()->forget('user_signup_data');

            $request->session()->regenerate();
            $request->session()->regenerateToken();
            Auth::login($user);


            return redirect()->to('/categories')->with([
                'message' => 'تایید موفقیت‌آمیز بود.'
            ]);
        } else {
            return back()->withErrors(['اطلاعات ثبت‌نام موجود نیست.'])->withInput();
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('login')->with([
            'message' => 'کاربر با موفقیت خارج شد.'
        ]);

    }
}
