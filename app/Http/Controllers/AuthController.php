<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function sendOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phoneNumbers' => 'required|numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $otp = rand(100000, 999999);
        Otp::create([
            'phone' => $request->phoneNumbers,
            'otp' => $otp,
        ]);

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.kavenegar.com/v1/704865776F4C376665393662587063636D7630524B4132574C59586D783155455450495757556D715649553D/verify/lookup.json', [
                'query' => [
                    'receptor' => $request->phoneNumbers,
                    'token' => $otp,
                    'token2' => 'homeenger',
                    'template' => 'homeengerverify'
                ]
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if ($responseBody['return']['status'] == 200) {
                // انتقال به صفحه OTP با استفاده از redirect
                return redirect()->to('/api/otp')->with('phone', $request->phoneNumbers);
            } else {

                return back()->with('error', 'خطا در ارسال کد تایید.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ارسال کد تایید: ' . $e->getMessage());
        }
    }

    // public function userSignup(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'nullable|string|max:255',
    //         'family' => 'nullable|string|max:255',
    //         'phone' => 'required|numeric|digits:11',
    //         'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
    //         'educationLevel' => 'nullable|string|in:دیپلم,لیسانس,فوق لیسانس,دکترا',
    //         'gender' => 'nullable|string|in:زن,مرد',
    //     ]);

    //     // dd($request->all());
    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     $user = User::where('mobile', $request->phone)->first();

    //     if(!$user){
    //         User::create([
    //             'name' => $request->name,
    //             'family' => $request->family,
    //             'mobile' => $request->phone,
    //             'password' => bcrypt($request->password),
    //             'educationLevel' => $request->educationLevel,
    //             'gender' => $request->gender,

    //         ]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'User Updated Successfully',
    //             'phone' => $request->phone,
    //             'user' => $user,
    //         ], 200);

    //     }
    //     else
    //     {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'User not found',
    //             'phone' => $request->phone,
    //         ], 404);
    //     }
    // }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phoneNumbers' => 'required|numeric|digits:11',
       //     'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('mobile', $request->phoneNumbers)->first();
        if (!$user){
            return back()->withErrors(['This is a custom error message.'])->withInput();

        }
        // چک کردن رمز عبور
        if (!Hash::check($request->password, $user->password)) {
             return back()->withErrors(['رمز عبور نادرست است.'])->withInput();
        }

        Auth::login($user);

        return redirect()->route('main');
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

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('mobile', $request->phone)->first();

        if (!$user) {
            User::create([
                'name' => $request->name,
                'family' => $request->family,
                'mobile' => $request->phone,
                'password' => bcrypt($request->password),
                'educationLevel' => $request->educationLevel,
                'gender' => $request->gender,
            ]);

            // ارسال OTP
            return $this->sendOtp($request);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User already exists',
                'phone' => $request->phone,
            ], 409);
        }
    }
}
