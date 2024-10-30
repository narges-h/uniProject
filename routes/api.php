<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::prefix('v1')->group(function () {

// });


Route::get('/login', [AuthController::class, 'sendOtpPage'])->name('sendOtpPage');
Route::post('/main', [AuthController::class, 'login']);
Route::post('/auth', [AuthController::class, 'sendOtp']);

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'userSignup']);

Route::post('/auth/VerifyOtp', [AuthController::class, 'VerifyOtp']);

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::get('/otp', function () {
    return view('otp');
})->name('otp');











