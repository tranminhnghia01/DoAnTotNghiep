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
        $order = "";
        $book = "";
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();

        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')->where('shipping_id',$shipping->shipping_id)->orderBy('book_status', 'desc')->get();
        $city = City::all();

        // $book = Book::where('shipping_id',$shipping->id)->get();
        // dd($book);
        return view('frontend.setting.profile')->with(compact('book','shipping','user','city'));
    }


    public function edit($id)
    {

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


    public function show_Appointment()
    {

    }


    public function show(Request $request){
        $book_id = $request->book_id;
        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')->where('tbl_booking.book_id',$book_id)->first();

        $payment = Payment::find($book->payment_id);
        $coupon = Coupon::find($book->coupon_id);
        if($coupon == true){
            $coupon_number = $coupon->coupon_number;
            if($coupon->coupon_method == 0){
                $method = '%';
            }else{
                $method = 'đ';
            }
        }else{
            $coupon_number = '';
            $method = '';
        }
        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;padding-left: 0px">
                <div class="modal-dialog">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">

                            <div class="row g-3">
                                <h5 class="modal-title">Vị trí làm việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <p style="font-weight: 600">'.$shipping->shipping_name.'</p>
                                    <p> Số điện thoại: (+84)  '.$shipping->shipping_phone.'</p>
                                    <p> '.$shipping->shipping_address.'</p>
                                </div>
                                <h5 class="modal-title">Thông tin công việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                                    <p style="font-weight: 600">Thời gian làm việc</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Ngày làm việc</label>
                                        <p class="check-date">'.$book->book_date.' - '.$book->book_time_start.'</p>
                                    </div>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Làm trong</label>
                                        <p class="check-time">'.$book->book_time_number.' giờ, '.$book->book_time_start.' đến '.$time_end.'</p>
                                    </div>

                                    <p style="font-weight: 600">Chi tiết công việc</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Khối lượng công việc</label>
                                        <p class="check-g">105m<sup>2</sup></p>
                                    </div>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Dịch vụ thêm</label>
                                        <p id="options" class="check-options">'.$book->book_options.'</p>
                                    </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Ghi chú cho người làm</label>
                                        <p class="check-notes">'.$book->book_notes.'</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5 class="modal-title">Phương thức thanh toán</h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5 class="modal-title">Khuyễn mãi</h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p class="form-control border-0 bg-light" style="height: 55px;color:#000">'.$payment->payment_method.'</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p class="form-control border-0 bg-light" style="height: 55px;color:#000">'.$coupon_number.''.$method.'</p>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                        <h4 class="modal-title book-total">'.number_format($book->book_total).'<sup>đ</sup>  </h4>
                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary py-3">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }

//     public function destroy(Request $request){
//         $order_code = $request->order_code;
//         $order = Order::where('order_code',$order_code)->first();
//         if($order){
//             $order->update(['order_status'=>3]);
//             $msg = 'Hủy đơn đặt hàng thành công!';
//             $style = 'success';
//         }else{
//             $msg = 'Có lỗi xảy ra khi hủy đơn đặt hàng';
//             $style = 'danger';
//         }
//         echo $msg;
//     }

//     public function delete(Request $request){
//         $data = $request->all();
//         print_r($data);
//     }
}
