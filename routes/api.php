<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\fileUploadController;

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


Route::post('/auth', [AuthController::class, 'checkPhone']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/sendOtp', [AuthController::class, 'sendOtp']);


Route::post('/auth/generateOtp', [AuthController::class, 'generateRandomOTP']);
Route::post('/auth/upadteOtp', [AuthController::class, 'updateOtp']);


Route::post('/auth/register', [AuthController::class, 'createUser']);

Route::post('/userPanel/changePassword', [UserController::class, 'chengePassword']);
Route::get('/userPanel/userInfo', [UserController::class, 'getUserInfo']);
Route::post('/userPanel/userInfo', [UserController::class, 'userUpdate']);

Route::post('/userPanel/auth', [FileUploadController::class, 'UploadFiles']);






