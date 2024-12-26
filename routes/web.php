<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
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

Route::get('/otp', function () {
    return view('auth/otp');
})->name('otp');

Route::controller(MainController::class)->group(function () {
    // نمایش کتاب های یک دسته بندی
    Route::get('/books/category/{id}', 'showBooksByCategory')->name('books.byCategory');
    // نمایش همه کتاب ها
    Route::get('/categories', 'showCategoriesWithBooks')->name('categories.index');
    // نمایش جزئیات کتاب
    Route::get('/books/{id}', 'showBookDetails')->name('books.details');
});

Route::get('/admin/order/{id}/items',[AdminOrderController::class,'getOrderItems'] );

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'signup');
    Route::post('/userSignup', 'userSignup');
    Route::post('/verifyOtp', 'verifyOtp');
    Route::get('/login', 'sendOtpPage')->name('login');
    Route::post('/main', 'login');
    // خروج کاربر
    Route::post('/logout', 'logout')->name('logout');
});


Route::controller(BookController::class)->group(function () {
    // افزودن کتاب
    Route::post('/insert', 'insert')->name('insert');
    // فرم افزودن کتاب
    Route::get('/add-book', 'create')->name('add-book');
    // فرم ادیت کتاب
    Route::get('/update-book/{id}', 'edit')->name('update-book');
    // ادیت کتاب
    Route::put('/update/{id}', 'update')->name('update');
    // حذف کتاب
    Route::delete('/delete-book/{id}', 'delete')->name('delete-book');
    // جستوجوی کتاب
    Route::get('/search', 'search')->name('searchBooksCategories');
    //سورت کتاب ها
    Route::get('/admin/books/sort/{order}', 'index')->name('admin.books.sort');
     // پنل مدیریت (با میان‌افزار admin)
     Route::get('/admin', 'index')->middleware('admin')->name('admin.books');
});

Route::controller(ProfileController::class)->group(function () {
    // پروفایل کاربری
    Route::get('/profile', 'index')->name('profile.index');
    Route::get('/profile/{id}', 'edit')->name('profile.edit');
    Route::post('/profile', 'update')->name('profile.update');
    Route::post('/profile/change-password', 'changePassword')->name('profile.changePassword');
});


Route::middleware(['admin'])->group(function () {
    // Route::get('/admin', [BookController::class, 'index'])->name('admin.books');

    // مدیریت کاربران
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/users', 'showUsers')->name('admin.users');
        Route::delete('/admin/users/{id}', 'deleteUser')->name('admin.deleteUser');
    });


    // مدیریت دسته‌بندی‌ها
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin.categories');
        Route::post('/admin/categories', 'store')->name('admin.addCategory');
        Route::delete('/admin/categories/{id}', 'delete')->name('admin.deleteCategory');
        // نمایش فرم افزودن دسته‌بندی
        Route::get('/admin/category/create','create')->name('products.create');
        // ذخیره دسته‌بندی جدید

        Route::post('/admin/category','store')->name('admin.storeCategory');
        // نمایش فرم ویرایش دسته‌بندی
        Route::get('/admin/category/{id}/edit','edit')->name('admin.editCategory');
        // به‌روزرسانی دسته‌بندی
        Route::put('/admin/category/{id}','update')->name('admin.updateCategory');
    });
    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/admin/orders', 'index')->name('admin.orders');
        Route::put('/admin/updateStatus/{id}', 'updateStatus')->name('admin.orders.updateStatus');

    });
});

Route::middleware(['auth'])->group(function () {
    //   سبدخرید
    Route::controller(CartController::class)->group(function () {
        Route::post('/cart/add/{id}', 'addToCart')->name('cart.add');
        Route::get('/cart', 'showCart')->name('cart.show');
        Route::post('/cart/remove/{id}', 'removeFromCart')->name('cart.remove');
        Route::post('/cart/increase/{id}', 'increaseQuantity')->name('increaseQuantity');
        Route::post('/cart/decrease/{id}', 'decreaseQuantity')->name('decreaseQuantity');
    });

    // سفارش
    Route::controller(OrderController::class)->group(function () {
        Route::get('/checkout/address', 'showAddressForm')->name('checkout.address');
        Route::post('/checkout/address/cities/{province}', 'getCities');
        Route::post('/orders/store', 'storeOrder')->name('orders.store');
        Route::middleware('auth')->get('/orders', 'userOrders')->name('userOrders');
    });
    Route::get('/orders/success', function () {
        return view('success');
    })->name('orders.success');
});
