<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookCheckRequest;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Ward;
use Cron\MinutesField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

session_start();

class BookController extends Controller
{
    public function index(){
        $title = "Đăt lịch";
        $pagination = "Đặt lịch" ;
        $user = "";
        $shipping = "";
        $product = Product::all();
        $city = City::all();
        $province = Province::all();
        $ward = Ward::all();

        $user_id = Auth::id();
        if($user_id){
            $user = User::findOrFail($user_id);
            $shipping = Shipping::where('user_id', $user_id)->first();
        }


        $category = Category::where('category_level',1)->get();
        return view("frontend.book.book")->with(compact('product','city','province','ward','category','title','pagination','shipping'));
    }
    public function create(BookRequest $request){
        $title = "Đăt lịch";
        $pagination = "Đặt lịch" ;
        $data = $request->all();
        // dd($data);
        $payment = Payment::all();
        $start =$data['book_time_start'];
        $end =$data['book_time_end'];

        $betwend = $data['betwend'];
        $book_s = $data['book_s'];
        $time_start = explode(":",$start);
        $time_end = explode(":",$end);
        $total = 0;
        //Time sau 19h
        $time_after_df = 0;
        $price_df = 80000;


        $timestamp = strtotime($data['book_date']);
        $day = date('l', $timestamp);

        if($day == 'Saturday' || $day == 'Sunday'){
            $price_df = 90000;
            $total = $betwend * $price_df;
        }else{
            $total = $betwend * $price_df;
        }

        if ($time_end[0] >= 19 && $time_end[0] > 1) {
            $hours = $time_end[0] - 19 + $time_end[1]/60 ;
            $price_after = $hours * 10000;
            $total = $total + $price_after;
            $time_after_df = $hours;
        }

        $data['total'] = $total;
        $data['time_after_df'] = $time_after_df;
        $data['price_df'] = $price_df;


        // dd($data);
        if($betwend > 0){
            if($betwend > 6){
                $msg = 'Thời gian làm việc không vượt quá 6h';
                $style = 'warning';
            }if ($betwend >= $book_s && $betwend <= 6) {
                $msg = 'Thời gian hợp lệ';
                $style = 'success';
                return view('frontend.book.checkout_book')->with(compact('title','pagination','msg','style','data','payment'));

        } if($betwend < $book_s) {
            $msg = 'Thời gian làm việc tối thiểu là'.$book_s.'h';
            $style = 'warning';
        }
        }else{
            $msg = 'Thời gian kết thúc không hợp lệ';
            $style = 'danger';
        }

    }

    public function store(BookCheckRequest $request){
        $data = $request->all();
        $coupon_id = 0;
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $coupon_id = $coupon->id;
        }
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $shipping = Shipping::where('user_id', $user_id)->first();

        $time = explode("-",$data["book_time"]);
        $book_total = str_replace(',', '', $data['book_total']);

        $timestamp = strtotime($data['book_date']);
        $book_date = date('Y-m-d',$timestamp);

        $book_code = substr(md5(microtime()),rand(0,26),5);

        // $book_date = $data['book_address']->format('Y-m-d') ;
        // dd($book_date);
        $book = [
            'shipping_id' => $shipping->id,
            'payment_id'=>$data['payment_id'],
            'book_code'=>$book_code,
            'coupon_id' => $coupon_id,
            'book_address'=>$data['book_address'],
            'book_date'=>$book_date,
            'book_time_start'=>$time[0],
            'book_time_end'=>$time[1],
            'book_time_total' => $data['book_time_total'],
            'book_total' => $book_total,
            'book_status'=>1,
            'book_notes'=>$data['book_notes'],
        ];
        // dd($book);
        if (Book::create($book)) {
            Session::forget('coupon');
            $msg = 'Đơn đặt lịch của bạn đã được đặt thành công';
            $style = 'success';
        }else{
            $msg = 'Đã có lỗi xảy ra khi tiến hành đặt lịch, Vui lòng kiểm tra lại!';
            $style = 'warning';
        }
        return redirect()->route('home.book.index')->with('success', $msg);

    }

    public function check_coupon(Request $request){
        $data = $request->all();
        // dd($data);
        $coupon = Coupon::where('coupon_code',$data['coupon_code'])->first();

        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_method' => $coupon->coupon_method,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_method' => $coupon->coupon_method,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
            $msg = "Mã giảm giá đúng";
            }

        }else{
            $msg ="Mã giảm giá không đúng";
        }

        return $msg;
    }

    public function edit($book_code){
        $title = "Đăt lịch";
        $pagination = "Cập nhật" ;
        $book = Book::where('book_code', $book_code)->first();
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $shipping = Shipping::where('user_id', $user_id)->first();
        return view('frontend.user.order.edit')->with(compact('book','title','pagination','shipping'));
    }

    public function update($book_code){
        dd($book_code);
    }


}
