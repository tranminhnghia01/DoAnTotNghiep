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
*/
// Route::prefix('/')->name('home.')->group(function (){

//     Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');
//     Route::get('/Shop/login', [App\Http\Controllers\frontend\LoginController::class,'index'])->name('login')->middleware('memberNotLogin');
//     Route::post('/Shop/login', [App\Http\Controllers\frontend\LoginController::class,'login'])->middleware('member');
//     Route::get('/Shop/register', [App\Http\Controllers\frontend\LoginController::class,'show_register'])->name('register');
//     Route::post('/Shop/register', [App\Http\Controllers\frontend\LoginController::class,'register']);
//     Route::get('/Shop/logout', [App\Http\Controllers\frontend\LoginController::class,'logout'])->name('logout');

//     Route::post('/select-address',[App\Http\Controllers\frontend\LoginController::class,'select_address'])->name('select-address');


//     //Profile
//     Route::get('/Shop/Account', [App\Http\Controllers\frontend\UserController::class,'index'])->name('account.index');
//     Route::get('/Shop/Account/edit/{id}', [App\Http\Controllers\frontend\UserController::class,'edit'])->name('account.edit');
//     Route::post('/Shop/Account/edit/{id}', [App\Http\Controllers\frontend\UserController::class,'update'])->name('account.update');

//     Route::get('/Shop/Account/order', [App\Http\Controllers\frontend\UserController::class,'show_order'])->name('account.order.index');
//     Route::get('/Shop/Account/order/{order_code}', [App\Http\Controllers\frontend\UserController::class,'show_order_details'])->name('account.order.details');
//     Route::get('/Shop/Account/order-book/{book_code}', [App\Http\Controllers\frontend\UserController::class,'show_book_details'])->name('account.book.details');

//     Route::post('/Shop/Account/order-book/destroy', [App\Http\Controllers\frontend\UserController::class,'book_destroy'])->name('account.book.destroy');

//     Route::post('/Shop/Account/order/destroy', [App\Http\Controllers\frontend\UserController::class,'order_destroy'])->name('account.order.destroy');





//     ///Edit update đơn đặt lịch
//     // Route::get('/Shop/Account/order-book/edit/{book_code}', [App\Http\Controllers\frontend\BookController::class,'edit'])->name('account.book.edit');
//     // Route::post('/Shop/Account/order-book/update/{book_code}', [App\Http\Controllers\frontend\BookController::class,'update']);






//     Route::resource('/Shop/Product', App\Http\Controllers\frontend\ProductController::class);
//     Route::resource('/Shop/Blog', App\Http\Controllers\frontend\BlogController::class);
//     // Route::resource('cart', App\Http\Controllers\frontend\CartController::class);
//     Route::post('/Shop/Cart/{id}', [App\Http\Controllers\frontend\CartController::class,'add_Cart'])->name('add-cart');
//     Route::get('/Shop/Cart', [App\Http\Controllers\frontend\CartController::class,'show_Cart'])->name('show-cart');
//     //Update qty cart
//     Route::get('/Shop/Cart/change-quantity', [App\Http\Controllers\frontend\CartController::class,'quantity_change'])->name('quantity-change');

//     //Save cart order
//     Route::post('/Shop/Order', [App\Http\Controllers\frontend\CartController::class,'save_Cart'])->name('save-cart');



//     //checkout
//     Route::get('/Shop/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'index'])->name('checkout');
//     Route::post('/Shop/checkout/edit/{id}', [App\Http\Controllers\frontend\CheckoutController::class,'update'])->name('checkout.update');
//     // Route::resource('/Shop/book', App\Http\Controllers\frontend\BookController::class);


//     Route::post('/Shop/checkout/order', [App\Http\Controllers\frontend\CheckoutController::class,'order_index'])->name('order-index');
//     //coupon
//     Route::post('/Shop/checkout/coupon', [App\Http\Controllers\frontend\CheckoutController::class,'check_coupon'])->name('coupon');

//     Route::get('/Shop/book/checkcoupon', [App\Http\Controllers\frontend\BookController::class,'check_coupon'])->name('coupon-book');



//     Route::get('/Shop/book', [App\Http\Controllers\frontend\BookController::class,'index'])->name('book.index');
//     Route::get('/Shop/book/checkout', [App\Http\Controllers\frontend\BookController::class,'create'])->name('book.create');

//     Route::post('/Shop/book/checkout_save', [App\Http\Controllers\frontend\BookController::class,'store'])->name('book.store');



//     // Route::resource('/Shop/book', App\Http\Controllers\frontend\BookController::class);

//     //show product with prodcur
//     Route::get('/Shop/Product/Category/{id}', [App\Http\Controllers\frontend\CategoryController::class,'index'])->name('product.category');



// });

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});



///////Backend
Auth::routes();
Route::prefix('/home')->name('admin.')->middleware('admin')->group(function ()
{
    Route::post('/select-address',[App\Http\Controllers\HomeController::class,'select_address'])->name('select-address');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\HomeController::class,'logout'])->name('logout');
    Route::get('/account/profile', [App\Http\Controllers\admin\UserController::class,'index'])->name('account');
    Route::post('/account/profile', [App\Http\Controllers\admin\UserController::class,'update'])->name('account.update');
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/logout', [App\Http\Controllers\HomeController::class,'logout'])->name('logout');
    // Route::get('/account-setting/account', [App\Http\Controllers\admin\UserController::class,'index'])->name('account');
    // Route::post('/account-setting/account/{id}', [App\Http\Controllers\admin\UserController::class,'update'])->name('update.account');
    // Route::post('/account-setting/avatar', [App\Http\Controllers\admin\UserController::class,'Upload_Image'])->name('uploadfile');
    // ///select address
    // Route::post('/select-address',[App\Http\Controllers\admin\UserController::class,'select_address'])->name('select-address');
    // //show image
    // Route::post('/account-setting/show-image', [App\Http\Controllers\admin\UserController::class,'show_image'])->name('show-image');

    // ///BLog
    // Route::resource('blog', App\Http\Controllers\admin\BlogController::class);
    // Route::resource('category', App\Http\Controllers\admin\CategoryController::class);
    // Route::resource('coupon', App\Http\Controllers\admin\CouponController::class);

    // Route::resource('product', App\Http\Controllers\admin\ProductController::class);
    // Route::resource('account-users', App\Http\Controllers\admin\MemberController::class);
    // Route::get('/account-giupviec', [App\Http\Controllers\admin\MemberController::class,'Account_Giupviec'])->name('account-giupviec');

    // Route::resource('account-order', App\Http\Controllers\admin\OrderController::class);

    // Route::get('/account-book/{book_code}', [App\Http\Controllers\admin\OrderController::class,'show_book'])->name('account-book');


});
