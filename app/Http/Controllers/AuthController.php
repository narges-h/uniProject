<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class AuthController extends Controller
{


    public function login()
    {
        return view('login');
    }

    public function sendOtp(Request $request)
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

        $otp = rand(100000, 999999);
        Otp::create([
            'phone' => $request->phone,
            'otp' => $otp,
        ]);

             // ارسال کد OTP به کاربر با استفاده از API کاوه‌نگار
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.kavenegar.com/v1/704865776F4C376665393662587063636D7630524B4132574C59586D783155455450495757556D715649553D/verify/lookup.json', [
                'query' => [
                    'receptor' => $request->phone,
                    'token' => $otp,
                    'token2' => 'homeenger',
                    'template' => 'homeengerverify'
                ]
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if ($responseBody['return']['status'] == 200) {
                return response()->json([
                    'status' => true,
                    'message' => 'ثبت‌نام موفقیت‌آمیز بود. لطفاً کد تایید را وارد کنید.',
                    'phone' => $request->phone,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'خطا در ارسال کد تایید.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'خطا در ارسال کد تایید.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function signup()
    {
        return view('signup');
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:11',
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $otpRecord = Otp::where('phone', $request->phone)->where('otp', $request->otp)->first();
        if (!$otpRecord) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP code.',
            ], 400);
        }

        $user = User::where('mobile', $request->phone)->first();
        $userExisted = true;

        if (!$user) {
            $user = User::create([
                'mobile' => $request->phone,
                'is_verified' => true, // فرض بر این است که کاربر پس از تایید OTP تایید شده است.
            ]);
            $userExisted = false; // کاربر جدید ایجاد شد
        } else {
            $user->is_verified = true;
            $user->save();
        }

        // حذف رکورد OTP پس از استفاده
        $otpRecord->delete();

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Verification successful.',
            'phone' => $request->phone,
            'token' => $token,  // بازگرداندن توکن
            'userExisted' => $userExisted, // نشان دهنده اینکه کاربر قبلاً وجود داشته است یا خیر
        ]);
    }

    public function userSignup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'educationLevel' => 'nullable|string|in:دیپلم,لیسانس,فوق لیسانس,دکترا',
            'gender' => 'nullable|string|in:زن,مرد',
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::where('phone', $request->phone)->first();

        if($user){
            $user->update([
                'name' => $request->name,
                'family' => $request->family,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'educationLevel' => $request->educationLevel,
                'gender' => $request->gender,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
                'phone' => $request->phone,
                'user' => $user,
            ], 200);

        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'phone' => $request->phone,
            ], 404);
        }
    }
}
