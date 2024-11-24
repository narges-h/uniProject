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


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





Route::get('/books/category/{id}', [MainController::class, 'showBooksByCategory'])->name('books.byCategory');
Route::get('/categories', [MainController::class, 'showCategoriesWithBooks'])->name('categories.index');
Route::get('/books/{id}', [MainController::class, 'showBookDetails'])->name('books.details');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

Route::middleware(['auth'])->group(function(){
    Route::get('/categories', [MainController::class, 'showCategoriesWithBooks'])->name('categories.index');
});


Route::post('/insert', [BookController::class, 'insert'])->name('insert');
Route::get('/add-book', [BookController::class, 'create'])->name('add-book'); 





