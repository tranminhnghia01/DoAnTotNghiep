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
// Route::get('/test', [MailController::class,'index']);
// Route::get('/modal', [MailController::class,'modal']);

Route::prefix('/Moon.com')->name('home.')->group(function (){
    Route::get('/', [App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');
    Route::get('/login', [App\Http\Controllers\frontend\LoginController::class,'index'])->name('login')->middleware('memberNotLogin');
    Route::post('/login', [App\Http\Controllers\frontend\LoginController::class,'login'])->middleware('member');
    Route::get('/register', [App\Http\Controllers\frontend\LoginController::class,'show_register'])->name('register')->middleware('memberNotLogin');
    Route::post('/register', [App\Http\Controllers\frontend\LoginController::class,'register']);
    Route::get('/logout', [App\Http\Controllers\frontend\LoginController::class,'logout'])->name('logout');


    // begin Nav
        // Route::get('/services', [App\Http\Controllers\frontend\ServiceController::class, 'index'])->name('home-service');
        // Route::get('/services/show/{service_id}', [App\Http\Controllers\frontend\ServiceController::class, 'show'])->name('home-service.show');

        Route::get('/houses', [App\Http\Controllers\frontend\HomeController::class, 'housekeeper'])->name('home-housekeeper');
        Route::get('/houses/show/{housekeepet_id}', [App\Http\Controllers\frontend\HomeController::class, 'housekeeper_show'])->name('home-housekeeper.show');
        Route::resource('blog', App\Http\Controllers\frontend\BlogController::class);
        Route::resource('service', App\Http\Controllers\frontend\ServiceController::class);


    // End Nav

    //user register housekeeper
    Route::get('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper'])->name('housekeeper');
    Route::post('/housekeeper', [App\Http\Controllers\frontend\LoginController::class,'housekeeper_store']);



    Route::post('/select-address',[App\Http\Controllers\frontend\LoginController::class,'select_address'])->name('select-address');


    //Appointmet Fix
    Route::get('/giup-viec-ca-le/create', [App\Http\Controllers\frontend\AppointmentController::class, 'create_Cale'])->name('create.giup-viec-ca-le');
    Route::get('/giup-viec-ca-co-dinh/create', [App\Http\Controllers\frontend\AppointmentController::class, 'create_Codinh'])->name('create.giup-viec-ca-co-dinh');


    Route::get('/giup-viec/check_Booking', [App\Http\Controllers\frontend\AppointmentController::class, 'check_Booking'])->name('giup-viec.check-Booking');
    Route::post('giup-viec-dat-lich/store', [App\Http\Controllers\frontend\AppointmentController::class, 'store'])->name('giup-viec.store');





    //end service

    Route::get('/checkout', [App\Http\Controllers\frontend\UserController::class,'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\frontend\UserController::class,'update']);

    Route::get('/Account', [App\Http\Controllers\frontend\UserController::class,'index'])->name('appointment.index');
    Route::post('/Account/update', [App\Http\Controllers\frontend\UserController::class,'update'])->name('Account.update');
    Route::get('/Account/quan-ly-don', [App\Http\Controllers\frontend\UserController::class,'quan_ly_don'])->name('Account.show');
    Route::get('/Account/quan-ly-don/{book_id}', [App\Http\Controllers\frontend\UserController::class,'quan_ly_don_details'])->name('Account.show.details');


    //ca cố định
    Route::get('/Account/cale', [App\Http\Controllers\frontend\UserController::class,'show'])->name('appointment.show');
    Route::post('/Account/huy-cale', [App\Http\Controllers\frontend\UserController::class,'destroy'])->name('appointment.destroy');


    //Danh gia
    Route::get('/Account/Danh-gia', [App\Http\Controllers\frontend\BookingController::class,'danhgia'])->name('appointment.danhgia');
    Route::post('/Account/Danh-gia', [App\Http\Controllers\frontend\BookingController::class,'post_danhgia']);


    //Phương thức thanh toán
    Route::post('/Account/payment/online/{book_id}', [App\Http\Controllers\frontend\BookingController::class,'payment_Online'])->name('appointment.payment.online');
    // Route::post('/momo', [App\Http\Controllers\frontend\BookingController::class,'momo_Online'])->name('momo');
    // Route::post('/onepay', [App\Http\Controllers\frontend\BookingController::class,'onepay_Online'])->name('onepay');

    Route::get('dat-lich/thanks',[App\Http\Controllers\HomeController::class, 'thanks'])->name('thanks');

});




///////Backend
Auth::routes();
Route::prefix('/home')->name('admin.')->middleware('admin')->group(function ()
{
    Route::post('/select-address',[App\Http\Controllers\HomeController::class,'select_address'])->name('select-address');
    Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\HomeController::class,'logout'])->name('logout');
    Route::get('/account/profile', [App\Http\Controllers\admin\AccountController::class,'index'])->name('account');
    Route::post('/account/profile', [App\Http\Controllers\admin\AccountController::class,'update'])->name('account.update');
    Route::post('/change-password', [App\Http\Controllers\admin\AccountController::class, 'updatePassword'])->name('update-password');
    //Xem nhanh
    Route::get('/Account/show', [App\Http\Controllers\admin\BookingController::class,'fast_Show'])->name('details.show');
    Route::get('/Account/bill/details/{book_id}', [App\Http\Controllers\admin\BookingController::class,'show'])->name('details-book.show');



    Route::resource('housekeeper', App\Http\Controllers\admin\HousekeeperController::class);
    Route::resource('Nguoi-dung', App\Http\Controllers\admin\MemberController::class);

     //show appointment housekeeper
    // Route::get('/details-housekeeper/{housekeeper_id}', [App\Http\Controllers\admin\HousekeeperController::class,'show_Details'])->name('housekeeper.appointment-details');
    Route::post('/details-housekeeper/showfe/{housekeeper_id}', [App\Http\Controllers\admin\HousekeeperController::class,'showfe'])->name('housekeeper.showfe');



    Route::resource('service', App\Http\Controllers\admin\ServiceController::class);
    Route::resource('coupon', App\Http\Controllers\admin\CouponController::class);
    Route::resource('blog', App\Http\Controllers\admin\BlogController::class);


    ///Apppointment
    Route::resource('appointment', App\Http\Controllers\admin\BookingController::class);
    Route::get('/appointment/confirm/{book_id}', [App\Http\Controllers\admin\BookingController::class,'confirm'])->name('appointment.confirm');
    Route::post('/appointment-confirm/{book_id}', [App\Http\Controllers\admin\BookingController::class,'post_Confirm'])->name('appointment.post-confirm');
    //Tìm kiếm
    Route::get('/search-confirm', [App\Http\Controllers\admin\BookingController::class,'search_confirm'])->name('appointment.search-confirm');


    //Hóa đơn
    Route::get('/hoa-don/chua-duyet', [App\Http\Controllers\admin\BillController::class, 'index'])->name('hoadon');
    Route::get('/hoa-don/chua-duyet/update/{history_id}', [App\Http\Controllers\admin\BillController::class,'index_handle'])->name('hoadon-update');
    Route::get('/hoa-don/da-duyet', [App\Http\Controllers\admin\BillController::class, 'hoadon_processing'])->name('hoadon-processing');

    //Thống kê
    Route::get('/Thong-ke', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('thongke-index');
    Route::get('/Thong-ke/don-lich', [App\Http\Controllers\admin\DashboardController::class, 'thongke_donlich'])->name('thongke-donlich');
    Route::post('/Thong-ke/filter-by-date', [App\Http\Controllers\admin\DashboardController::class, 'filter_by_date'])->name('thongke-filter-by-date');
    Route::post('/Thong-ke/dashboard-filter', [App\Http\Controllers\admin\DashboardController::class, 'dashboard_filter'])->name('thongke-dashboard-filter');
    Route::post('/Thong-ke/dashboard-days', [App\Http\Controllers\admin\DashboardController::class, 'dashboard_days'])->name('thongke-dashboard-days');

    Route::get('/Thong-ke/dashboard-book', [App\Http\Controllers\admin\DashboardController::class, 'total_book'])->name('thongke-dashboard-book');
    Route::get('/Thong-ke/dashboard-sales', [App\Http\Controllers\admin\DashboardController::class, 'total_sales'])->name('thongke-dashboard-sales');
    Route::get('/Thong-ke/dashboard-profit', [App\Http\Controllers\admin\DashboardController::class, 'total_profit'])->name('thongke-dashboard-profit');

    Route::get('/Thong-ke/dashboard-quickview', [App\Http\Controllers\admin\DashboardController::class, 'total_quickview'])->name('thongke-dashboard-quickview');




    ///Đánh giá bình luận
    Route::get('/Đanh-gia', [App\Http\Controllers\admin\CommentController::class, 'index'])->name('comment.index');
    Route::post('/reply/{comment_id}', [App\Http\Controllers\admin\CommentController::class, 'reply'])->name('comment.reply');

    //Bảng giá
    Route::get('/Bang-gia', [App\Http\Controllers\admin\CommentController::class, 'banggia'])->name('banggia.index');




    // Chức năng người giúp việc
    Route::get('/Appoin/list', [App\Http\Controllers\Housepicker\BookingController::class,'index'])->name('Appoin-index');
    Route::get('/Appoin/profile', [App\Http\Controllers\Housepicker\BookingController::class,'profile'])->name('Appoin-profile');
    Route::get('/Appoin/Bill', [App\Http\Controllers\Housepicker\BillController::class,'index'])->name('Appoin-bill');
    Route::get('/Appoin/ChamCong/{book_id}', [App\Http\Controllers\Housepicker\BillController::class,'ChamCong'])->name('Appoin-ChamCong');
    Route::post('/Appoin/list/destroy', [App\Http\Controllers\Housepicker\BillController::class,'destroy'])->name('Appoin-detail-destroy');

});
