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

        $user_id= Auth::id();
        $user = User::findOrFail($user_id);
        $city = City::all();
        $province = Province::all();
        $ward = Ward::all();
        $payment = Payment::all();

        //get shipping info
        $shipping = Shipping::where('user_id', $user_id)->first();
        $name = explode(' ',$shipping->shipping_name);
        $first_name = array_pop($name);
        $last_name = implode(' ', $name);

        return view("frontend.checkout.checkout")->with(compact('city','province','ward','user','payment','shipping','first_name','last_name'));
    }



    public function update(Request $request, $id){
        $data= $request->all();
        $data['shipping_name'] = $data['first_name'].' '.$data['last_name'];

        $user_id = Auth::id();
        $data['user_id'] = $user_id;

        $shipping = Shipping::where('user_id', $user_id)->first();

        if ($shipping->update($data)) {
            $msg = "Xác nhận địa chỉ thanh toán thành công";
            $style ="success";
        }
        else{
            $msg = "Xác nhận địa chỉ thanh toán không thành công thành công";
            $style ="warning";
        }
        return redirect()->route('home.show-cart')->with(compact('msg','style'));

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
