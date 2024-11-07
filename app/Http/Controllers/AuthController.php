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

class AuthController extends Controller
{


    public function sendOtpPage()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function sendOtp($phoneNumbers)
    {
        $otp = rand(100000, 999999);

        Otp::create([
            'phone' => $phoneNumbers,
            'otp' => $otp,
        ]);


        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.kavenegar.com/v1/704865776F4C376665393662587063636D7630524B4132574C59586D783155455450495757556D715649553D/verify/lookup.json', [
                'query' => [
                    'receptor' => $phoneNumbers,
                    'token' => $otp,
                    'token2' => 'homeenger',
                    'template' => 'homeengerverify'
                ]
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if ($responseBody['return']['status'] == 200) {
                // انتقال به صفحه OTP با استفاده از redirect
                return redirect()->to('/otp')->with('phoneNumbers', $phoneNumbers);
            } else {

                return back()->with('error', 'خطا در ارسال کد تایید.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ارسال کد تایید: ' . $e->getMessage());
        }
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
        // چک کردن رمز عبور
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['رمز عبور نادرست است.'])->withInput();
        }

        Auth::login($user);

        // ذخیره نام و نام خانوادگی در سشن
        session(['user_name' => $user->name . ' ' . $user->family]);
        return redirect()->to('/landing');
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

        // ارسال OTP و ذخیره اطلاعات اولیه کاربر در سشن
        // session(['user_signup_data' => $request->only(['name', 'family', 'phoneNumbers', 'password', 'educationLevel', 'gender'])]);

        session([
            'user_signup_data' => $request->only(['name', 'family', 'phoneNumbers', 'password', 'educationLevel', 'gender']),
            'user_name' => $request->name . ' ' . $request->family
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
            return redirect()->to('/otp')
                ->withErrors($validator)
                ->withInput();
        }

        $otpRecord = Otp::where('phone', $request->phoneNumbers)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord) {
            return redirect()->to('/otp')
                ->with('error', 'کد تایید وارد شده نادرست است.')
                ->withInput();
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

            // $token = $user->createToken('API Token')->plainTextToken;

            return redirect()->to('/landing')->with([
                'message' => 'تایید موفقیت‌آمیز بود.'
            ]);
        } else {
            return redirect()->to('/otp')
                ->with('error', 'اطلاعات ثبت‌نام موجود نیست.')
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            Auth::logout();

            // پاک کردن سشن
            $request->session()->flush();

            return response()->json([
                'message' => 'کاربر با موفقیت خارج شد.'
            ]);
        } else {
            return response()->json([
                'message' => 'کاربر یافت نشد.'
            ], 404);
        }
    }
}
