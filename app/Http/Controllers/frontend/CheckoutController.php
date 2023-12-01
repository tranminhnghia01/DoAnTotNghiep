<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

session_start();


class CheckoutController extends Controller
{
    public function index(Request $request){

        $id= Auth::id();
        $user = User::findOrFail($id);
        $city = City::all();
        $payment = Payment::all();

        //get shipping info
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        // dd($shipping);

        return view("frontend.checkout.checkout")->with(compact('city','user','payment','shipping'));
    }



    public function update(Request $request){
        $data= $request->all();
        // dd($data);

        $id = Auth::id();
        $user = User::findOrFail($id);


        // $shipping = Shipping::where('user_id', $user_id)->first();
        $shipping = Shipping::where('user_id', $user->user_id)->first();

        // dd($shipping);

        if ($shipping->update($data)) {
            $msg = "Xác nhận địa chỉ thanh toán thành công";
            $style ="success";
        }
        else{
            $msg = "Đã  có lỗi xảy ra!";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));

    }

    public function check_coupon(Request $request){
        $data = $request->all();
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
        //  Session::forget('coupon');

                $msg = 'Thêm mã giảm giá thành công';
                $style = 'success';
            }

        }else{
            $msg = 'Mã giảm giá không đúng';
                $style = 'danger';
        }
        return redirect()->back()->with(compact('msg','style'));

    }

}
