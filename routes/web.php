<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [AuthController::class, 'signup']);

Route::get('/otp', function () {
    return view('otp');
})->name('otp');



Route::post('/userSignup', [AuthController::class, 'userSignup']);


Route::post('/verifyOtp', [AuthController::class, 'verifyOtp']);

Route::get('/login', [AuthController::class, 'sendOtpPage']);
Route::post('/main', [AuthController::class, 'login']);

Route::get('/landing', function () {
    return view('main');
})->name('landing');


