<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        return view('frontend.user.profile')->with('user', $user);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $city = City::all();
        $province = Province::all();
        $ward =Ward::all();

        $name = explode(' ',$user->name);
        $first_name = array_pop($name);
        $last_name = implode(' ', $name);
        return view('frontend.user.profile-edit')->with(compact('user','city','province','ward','first_name','last_name'));
    }

    public function update(Request $request, $id)
    {
        $data =$request->all();
        $data['name'] = $data['firstname'].' '.$data['lastname'];
        $user = User::findOrFail($id);

        if ($user->avatar != 0) {
            $old_img = $user->avatar;
        }
        // dd($old_img);
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = rand(0,99).$file->getClientOriginalName();
        }

        if($user->update($data)){
            if (!empty($file)) {
                $file->move('uploads/users',$data['avatar']);
                if($old_img){
                    $path = public_path('uploads/users/'. $old_img);;
                    unlink($path);
                }
            }
            $style = 'success';
            $msg = 'Cập nhật tài khoản thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi tiến hành cập nhật. ';
        };

        return redirect()->route('home.account.index')->with(compact('msg','style'));
    }


    public function show_order()
    {
        $order = "";
        $book = "";
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $shipping = Shipping::where('user_id',$user_id)->first();
        $order = Order::where('shipping_id',$shipping->id)->get();
        $book = Book::where('shipping_id',$shipping->id)->get();

        return view('frontend.user.order')->with(compact('book','order','shipping'));
    }

    public function show_order_details($order_code){
        $order_details = OrderDetails::where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->first();
        // dd($order->order_id);
        return view('frontend.user.order-details')->with(compact('order_details','order'));
    }


    public function show_book_details($book_code){
        $book_details = Book::where('book_code',$book_code)->first();
        $shipping_id = $book_details->shipping_id;
        // dd($shipping_id);
        $shipping = Shipping::where('id',$shipping_id)->first();
        $payment = Payment::all();
        $coupon_id = $book_details->coupon_id;
        // dd($coupon_id);
        if($coupon_id != 0){
            $coupon = Coupon::where('id',$coupon_id)->first();
        }else{
            $coupon = 0;
        }

        return view('frontend.user.order-book-details')->with(compact('book_details','shipping','payment','coupon'));
    }

    public function book_destroy(Request $request){
        $book_code = $request->book_code;
        $book = Book::where('book_code',$book_code)->first();
        if($book){
            $book->update(['book_status'=>3]);
            $msg = 'Hủy đơn đặt lịch thành công!';
            $style = 'success';
        }else{
            $msg = 'Có lỗi xảy ra khi hủy đơn đặt lịch';
            $style = 'danger';
        }
        echo $msg;
    }

    public function order_destroy(Request $request){
        $order_code = $request->order_code;
        $order = Order::where('order_code',$order_code)->first();
        if($order){
            $order->update(['order_status'=>3]);
            $msg = 'Hủy đơn đặt hàng thành công!';
            $style = 'success';
        }else{
            $msg = 'Có lỗi xảy ra khi hủy đơn đặt hàng';
            $style = 'danger';
        }
        echo $msg;
    }

    public function delete(Request $request){
        $data = $request->all();
        print_r($data);
    }
}
