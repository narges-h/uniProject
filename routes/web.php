<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;

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
Route::get('/login', [AuthController::class, 'sendOtpPage'])->name('login');
Route::post('/main', [AuthController::class, 'login']);

// Route::middleware(['auth'])->group(function(){
//     Route::get('/landing', function () {
//         return view('main');
//     })->name('landing');
// });

// خروج کاربر
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// نمایش کتاب های یک دسته بندی
Route::get('/books/category/{id}', [MainController::class, 'showBooksByCategory'])->name('books.byCategory');

// نمایش همه کتاب ها
Route::middleware(['auth'])->group(function(){
    Route::get('/categories', [MainController::class, 'showCategoriesWithBooks'])->name('categories.index');
});

// نمایش جزئیات کتاب
Route::get('/books/{id}', [MainController::class, 'showBookDetails'])->name('books.details');

// افزودن به سبدخرید
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// افزودن کتاب
Route::post('/insert', [BookController::class, 'insert'])->name('insert');
// فرم افزودن کتاب
Route::get('/add-book', [BookController::class, 'create'])->name('add-book');

// فرم ادیت کتاب
Route::get('/update-book/{id}', [BookController::class, 'edit'])->name('update-book');
// ادیت کتاب
Route::put('/update/{id}', [BookController::class, 'update'])->name('update');

// حذف کتاب
Route::delete('/delete-book/{id}', [BookController::class, 'delete'])->name('delete-book');








