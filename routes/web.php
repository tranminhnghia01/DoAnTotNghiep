<?php

use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\MailController;
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
// test email
Route::get('/test', [MailController::class,'index']);
Route::get('/modal', [MailController::class,'modal']);


Route::prefix('/Moon.com')->name('home.')->group(function (){
    Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');
    Route::get('/login', [App\Http\Controllers\frontend\LoginController::class,'index'])->name('login')->middleware('memberNotLogin');
    Route::post('/login', [App\Http\Controllers\frontend\LoginController::class,'login'])->middleware('member');
    Route::get('/register', [App\Http\Controllers\frontend\LoginController::class,'show_register'])->name('register')->middleware('memberNotLogin');
    Route::post('/register', [App\Http\Controllers\frontend\LoginController::class,'register']);
    Route::get('/logout', [App\Http\Controllers\frontend\LoginController::class,'logout'])->name('logout');


    // begin Nav
    Route::get('/services', [App\Http\Controllers\frontend\HomeController::class, 'service'])->name('home-service');
    Route::get('/houses', [App\Http\Controllers\frontend\HomeController::class, 'housekeeper'])->name('home-housekeeper');

    // End Nav

    //user register housekeeper
    Route::get('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper'])->name('housekeeper');
    Route::post('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper_store']);



    Route::post('/select-address',[App\Http\Controllers\frontend\LoginController::class,'select_address'])->name('select-address');


    //Appointmet Fix
    Route::get('/giup-viec-ca-le', [App\Http\Controllers\frontend\AppointmentController::class, 'index_Cale'])->name('giup-viec-ca-le');
    Route::get('/giup-viec-ca-le/create', [App\Http\Controllers\frontend\AppointmentController::class, 'create_Cale'])->name('giup-viec-ca-le.create');

    Route::get('/giup-viec-ca-co-dinh', [App\Http\Controllers\frontend\AppointmentController::class, 'index_Codinh'])->name('giup-viec-ca-co-dinh');
    Route::get('/giup-viec-ca-co-dinh/create', [App\Http\Controllers\frontend\AppointmentController::class, 'create_Codinh'])->name('giup-viec-ca-co-dinh.create');


    Route::get('/giup-viec/check_Booking', [App\Http\Controllers\frontend\AppointmentController::class, 'check_Booking'])->name('giup-viec.check-Booking');
    Route::post('giup-viec-dat-lich/store', [App\Http\Controllers\frontend\AppointmentController::class, 'store'])->name('giup-viec.store');



    //end service
    Route::get('/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\frontend\CheckoutController::class,'update']);

    Route::get('/Account', [App\Http\Controllers\frontend\UserController::class,'index'])->name('appointment.index');

    Route::get('/Account/show', [App\Http\Controllers\frontend\UserController::class,'show'])->name('appointment.show');
    Route::get('/Account/fixed-show', [App\Http\Controllers\frontend\UserController::class,'showfixed'])->name('appointment.showfixed');

    Route::post('/Account/destroy', [App\Http\Controllers\frontend\UserController::class,'destroy'])->name('appointment.destroy');
    Route::post('/Account/destroydefault', [App\Http\Controllers\frontend\UserController::class,'destroydefault'])->name('appointment.destroydefault');

    //ca cố định
    Route::get('/Account/details/{book_id}', [App\Http\Controllers\frontend\UserController::class,'details'])->name('appointment.details');



    Route::GET('dat-lich/thanks',[App\Http\Controllers\HomeController::class, 'thanks'])->name('thanks');





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


    Route::resource('service', App\Http\Controllers\admin\ServiceController::class);
    Route::resource('coupon', App\Http\Controllers\admin\CouponController::class);

    Route::resource('appointment', App\Http\Controllers\admin\BookingController::class);
    Route::resource('bill', App\Http\Controllers\admin\BillController::class);





    // Chức năng người giúp việc

    Route::get('/Appoin/new', [App\Http\Controllers\Housepicker\BookingController::class,'create'])->name('Appoin-create');
    Route::get('/Appoin/new/{book_id}', [App\Http\Controllers\Housepicker\BookingController::class,'store'])->name('Appoin-store');


    Route::get('/Appoin/confirm-new', [App\Http\Controllers\Housepicker\BookingController::class,'confirm'])->name('Appoin-confirm');
    Route::get('/Appoin/list', [App\Http\Controllers\Housepicker\BookingController::class,'index'])->name('Appoin-index');
    Route::get('/Appoin/profile', [App\Http\Controllers\Housepicker\BookingController::class,'profile'])->name('Appoin-profile');

    Route::get('/Appoin/Bill', [App\Http\Controllers\Housepicker\BillController::class,'index'])->name('Appoin-bill');
    Route::get('/Appoin/ChamCong/{book_id}', [App\Http\Controllers\Housepicker\BillController::class,'ChamCong'])->name('Appoin-ChamCong');


    Route::get('/Account/show', [App\Http\Controllers\admin\BookingController::class,'show'])->name('details.show');





});
