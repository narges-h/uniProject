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
}
