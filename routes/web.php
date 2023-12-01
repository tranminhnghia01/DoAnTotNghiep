<?php

use App\Http\Controllers\frontend\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');

Route::prefix('/Moon.com')->name('home.')->group(function (){
    Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');
    Route::get('/login', [App\Http\Controllers\frontend\LoginController::class,'index'])->name('login')->middleware('memberNotLogin');
    Route::post('/login', [App\Http\Controllers\frontend\LoginController::class,'login'])->middleware('member');
    Route::get('/register', [App\Http\Controllers\frontend\LoginController::class,'show_register'])->name('register')->middleware('memberNotLogin');
    Route::post('/register', [App\Http\Controllers\frontend\LoginController::class,'register']);
    Route::get('/logout', [App\Http\Controllers\frontend\LoginController::class,'logout'])->name('logout');

    //user register housekeeper
    Route::get('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper'])->name('housekeeper');
    Route::post('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper_store']);



    Route::post('/select-address',[App\Http\Controllers\frontend\LoginController::class,'select_address'])->name('select-address');

    ///begin service
    Route::get('/giup-viec-ca-le', [App\Http\Controllers\frontend\ServiceNoFixedController::class, 'index'])->name('giup-viec-ca-le');
    Route::get('/giup-viec-ca-le/create', [App\Http\Controllers\frontend\ServiceNoFixedController::class, 'create'])->name('giup-viec-ca-le.create');
    Route::post('/giup-viec-ca-le/create/store', [App\Http\Controllers\frontend\ServiceNoFixedController::class, 'store'])->name('giup-viec-ca-le.store');
    Route::post('/giup-viec-ca-le/create/check', [App\Http\Controllers\frontend\ServiceNoFixedController::class, 'check_Booking'])->name('giup-viec-ca-le.check');
    Route::get('/giup-viec-ca-co-dinh',[App\Http\Controllers\frontend\ServiceFixedController::class, 'index'])->name('giup-viec-ca-co-dinh');
    //end service


    Route::get('/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'update']);

    Route::get('/Account', [App\Http\Controllers\frontend\UserController::class,'index'])->name('appointment.index');
    Route::get('/Account/show', [App\Http\Controllers\frontend\UserController::class,'show'])->name('appointment.show');




//     //Profile
//     Route::get('/Account', [App\Http\Controllers\frontend\UserController::class,'index'])->name('account.index');
//     Route::get('/Account/edit/{id}', [App\Http\Controllers\frontend\UserController::class,'edit'])->name('account.edit');
//     Route::post('/Account/edit/{id}', [App\Http\Controllers\frontend\UserController::class,'update'])->name('account.update');

//     Route::get('/Account/order', [App\Http\Controllers\frontend\UserController::class,'show_order'])->name('account.order.index');
//     Route::get('/Account/order/{order_code}', [App\Http\Controllers\frontend\UserController::class,'show_order_details'])->name('account.order.details');
//     Route::get('/Account/order-book/{book_code}', [App\Http\Controllers\frontend\UserController::class,'show_book_details'])->name('account.book.details');

//     Route::post('/Account/order-book/destroy', [App\Http\Controllers\frontend\UserController::class,'book_destroy'])->name('account.book.destroy');

//     Route::post('/Account/order/destroy', [App\Http\Controllers\frontend\UserController::class,'order_destroy'])->name('account.order.destroy');





//     ///Edit update đơn đặt lịch
//     // Route::get('/Account/order-book/edit/{book_code}', [App\Http\Controllers\frontend\BookController::class,'edit'])->name('account.book.edit');
//     // Route::post('/Account/order-book/update/{book_code}', [App\Http\Controllers\frontend\BookController::class,'update']);






//     Route::resource('/Product', App\Http\Controllers\frontend\ProductController::class);
//     Route::resource('/Blog', App\Http\Controllers\frontend\BlogController::class);
//     // Route::resource('cart', App\Http\Controllers\frontend\CartController::class);
//     Route::post('/Cart/{id}', [App\Http\Controllers\frontend\CartController::class,'add_Cart'])->name('add-cart');
//     Route::get('/Cart', [App\Http\Controllers\frontend\CartController::class,'show_Cart'])->name('show-cart');
//     //Update qty cart
//     Route::get('/Cart/change-quantity', [App\Http\Controllers\frontend\CartController::class,'quantity_change'])->name('quantity-change');

//     //Save cart order
//     Route::post('/Order', [App\Http\Controllers\frontend\CartController::class,'save_Cart'])->name('save-cart');



//     //checkout
//     Route::get('/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'index'])->name('checkout');
//     Route::post('/checkout/edit/{id}', [App\Http\Controllers\frontend\CheckoutController::class,'update'])->name('checkout.update');
//     // Route::resource('/book', App\Http\Controllers\frontend\BookController::class);


//     Route::post('/checkout/order', [App\Http\Controllers\frontend\CheckoutController::class,'order_index'])->name('order-index');
//     //coupon
//     Route::post('/checkout/coupon', [App\Http\Controllers\frontend\CheckoutController::class,'check_coupon'])->name('coupon');

//     Route::get('/book/checkcoupon', [App\Http\Controllers\frontend\BookController::class,'check_coupon'])->name('coupon-book');



//     Route::get('/book', [App\Http\Controllers\frontend\BookController::class,'index'])->name('book.index');
//     Route::get('/book/checkout', [App\Http\Controllers\frontend\BookController::class,'create'])->name('book.create');

//     Route::post('/book/checkout_save', [App\Http\Controllers\frontend\BookController::class,'store'])->name('book.store');



//     // Route::resource('/book', App\Http\Controllers\frontend\BookController::class);

//     //show product with prodcur
//     Route::get('/Product/Category/{id}', [App\Http\Controllers\frontend\CategoryController::class,'index'])->name('product.category');



});




///////Backend
Auth::routes();
Route::prefix('/home')->name('admin.')->middleware('admin')->group(function ()
{
    Route::post('/select-address',[App\Http\Controllers\HomeController::class,'select_address'])->name('select-address');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\HomeController::class,'logout'])->name('logout');
    Route::get('/account/profile', [App\Http\Controllers\admin\AccountController::class,'index'])->name('account');
    Route::post('/account/profile', [App\Http\Controllers\admin\AccountController::class,'update'])->name('account.update');
    Route::post('/change-password', [App\Http\Controllers\admin\AccountController::class, 'updatePassword'])->name('update-password');


    Route::resource('housekeeper', App\Http\Controllers\admin\HousekeeperController::class);
    Route::resource('Users', App\Http\Controllers\admin\UserController::class);


    Route::resource('service', App\Http\Controllers\admin\ServiceController::class);
    Route::resource('coupon', App\Http\Controllers\admin\CouponController::class);


    // ///BLog
    // Route::resource('blog', App\Http\Controllers\admin\BlogController::class);
    // Route::resource('category', App\Http\Controllers\admin\CategoryController::class);

    // Route::resource('product', App\Http\Controllers\admin\ProductController::class);
    // Route::resource('account-users', App\Http\Controllers\admin\MemberController::class);

    // Route::resource('account-order', App\Http\Controllers\admin\OrderController::class);

    // Route::get('/account-book/{book_code}', [App\Http\Controllers\admin\OrderController::class,'show_book'])->name('account-book');

});
