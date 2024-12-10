<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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
Route::get('/categories', [MainController::class, 'showCategoriesWithBooks'])->name('categories.index');

// نمایش جزئیات کتاب
Route::get('/books/{id}', [MainController::class, 'showBookDetails'])->name('books.details');


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

// جستوجوی کتاب
Route::get('/search', [BookController::class, 'search'])->name('searchBooksCategories');



// ادمین
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [BookController::class, 'index'])->name('admin.books');
    // مدیریت کاربران
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    // مدیریت دسته‌بندی‌ها
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.addCategory');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'delete'])->name('admin.deleteCategory');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');

});

// پروفایل کاربری
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');


//سورت کتاب ها
Route::get('/admin/books/sort/{order}', [BookController::class, 'index'])->name('admin.books.sort');

//   سبدخرید
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});
Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');

// سفارش
Route::get('/checkout/address', [OrderController::class, 'showAddressForm'])->name('checkout.address');
Route::post('/orders/store', [OrderController::class, 'storeOrder'])->name('orders.store');
Route::get('/orders/success', function () {
    return view('success');
})->name('orders.success');

Route::middleware('auth')->get('/orders', [OrderController::class, 'userOrders'])->name('userOrders');


