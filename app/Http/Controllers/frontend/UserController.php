<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\City;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\History;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\PaymentOnline;
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

        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')->where('shipping_id',$shipping->shipping_id)->orderBy('book_status', 'desc')->get();
        $bookFixed = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')->where('shipping_id',$shipping->shipping_id)->where('service_id','2')->orderBy('book_status', 'desc')->get();

        $city = City::all();

        $check_comment = Comment::join('tbl_history', 'tbl_history.history_id', '=', 'tbl_comment.history_id')->get();
        // dd($check_comment);

        // $book = Book::where('shipping_id',$shipping->id)->get();
        // dd($book);
        return view('frontend.setting.profile')->with(compact('book','shipping','user','city','bookFixed','check_comment'));
    }


    public function edit($id)
    {

    }



    public function update(Request $request)
    {
        $data =$request->all();
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();

        // dd($user);
        if ($shipping->shipping_image != 0) {
            $old_img = $shipping->shipping_image;
        }
        // dd($old_img);
        $file = $request->shipping_image;
        // dd($file);
        if (!empty($file)) {
            $data['shipping_image'] = "nguoidung".rand(0,99).$file->getClientOriginalName();
        }

        if($shipping->update($data)){
            if (!empty($file)) {
                $file->move('uploads/users',$data['shipping_image']);
                if(!empty($old_img)){
                    $path = public_path('uploads/users/'. $old_img);
                    unlink($path);
                }
            }
            $style = 'success';
            $msg = 'Cập nhật tài khoản thành công! ';
        }else{
            $style = 'warning';
            $msg = 'Có lỗi xảy ra khi tiến hành cập nhật. ';
        };

        return redirect()->back()->with(compact('msg','style'));
    }





    public function show(Request $request){
        $book_id = $request->book_id;
        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')->where('tbl_booking.book_id',$book_id)->first();

        $payment = Payment::where('payment_id','!=',1)->get();
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
        $history = History::where('book_id',$book_id)->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')->first();
        // dd($history);
        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">

                            <div class="row g-3">';
                            if ($history) {
                                $path = asset('uploads/users/'. $history->image);

                                $output.='
                                <h5 class="modal-title">Người giúp việc</h5>
                                <div class="col-sm-3" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <img src="'.$path.'" alt="Girl in a jacket" width="150px" height="150px">
                                </div>
                                <div class="col-sm-9" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                <p style="font-weight: 600">'.$history->name.'</p>
                                <p> Số điện thoại: (+84)  '.$history->phone.'</p>
                            </div>';
                            }

                                $output.='
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
                                <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Khuyễn mãi</h5>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                                        <option selected>'.$coupon_number.''.$method.'</option>
                                    </select>
                                </div>
                            </div>

                                <div style="display: flex; justify-content: space-between">
                                    <div class="col-sm-4">
                                        <h5 class="modal-title">Phương thức thanh toán</h5>
                                    </div>
                                    <form action="'.route('home.appointment.payment.online',$book->book_id ).'" method="post"  class="col-sm-8">
                                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                                        <div class="row">
                                        <div class="col-sm-6">
                                            <select class="form-select border-0" style="height: 55px;" name="payment_id">';
                                            foreach ($payment as $key => $value) {
                                                $output .=' <option selected value="'.$value->payment_id.'">'.$value->payment_method.'</option>';

                                            }
                                                $output .='
                                            </select>
                                        </div>';
                                        if ($book->book_status == 2) {
                                            $output .='
                                            <div class="col-sm-6">
                                                <button type="submit" name="redirect"  class="btn btn-primary py-3" style="width:100%" ><i class="tf-ion-close">Thanh toán Online</i></button>
                                            </div>
                                            </div>
                                            ';
                                        }

                                        $output .='
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                        <h4 class="modal-title book-total">'.number_format($book->book_total).'<sup>đ</sup>  </h4>
                        </div>

                        <div class="modal-footer">
                        <form>
                        <input type="hidden" name="_token" value="'.csrf_token().'" />';
                        switch ($book->book_status) {
                            case 4:
                                $output .='
                            <button type="button"  class="btn btn-success py-3  "><i class="tf-ion-close" aria-hidden="true"> Đánh giá</i></button>
                           ';
                                break;

                                case 3:
                                    $output .='
                             <button type="button"  class="btn btn-primary py-3  "><i class="tf-ion-close" aria-hidden="true">Đăng lại</i></button>
                            ';
                            break;

                            default:
                            $output .='
                            <button type="button" class="btn btn-danger  py-3 btn-change-book" data-book-id="'.$book->book_id.'"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                        ';
                                break;
                        }
                            $output .='
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }


    //details ca cố định
    public function details($book_id){
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
        $history = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
        ->where('tbl_history.book_id',$book_id)
        ->first();

        return view('frontend.setting.Detailfixed')->with(compact('history'));
    }

    public function showfixed(Request $request){
        $book_id = $request->book_id;
        $weekday = [
            'Monday' => 'Thứ 2',
            'Tuesday' => 'Thứ 3',
            'Wednesday' => 'Thứ 4',
            'Thursday' => 'Thứ 5',
            'Friday' => 'Thứ 6',
            'Saturday' => 'Thứ 7',
            'Sunday' => 'CN',
        ];
        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')->where('tbl_booking.book_id',$book_id)->first();

        $payment = Payment::where('payment_id','!=',1)->get();
        $coupon = Coupon::find($book->coupon_id);

        $paymentonline = PaymentOnline::where('TxnRef',$book_id)->first();
        // dd($paymentonline);
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

        $listdate= explode(",",$book['book_date']);
         $count_date= count($listdate);
        // dd($count_date);
        for ($i=0; $i < $count_date; $i++) {
            $changedate = explode("/", $listdate[$i]);
             $listdate[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
            $timestamp = strtotime( $listdate[$i]);

        }
        // dd($listdate);
        $history = History::where('book_id',$book_id)->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')->first();
        // dd($history);
        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">

                            <div class="row g-3">';
                            if ($history) {
                                $path = asset('uploads/users/'. $history->image);

                                $output.='
                                <h5 class="modal-title">Người giúp việc</h5>
                                <div class="col-sm-3" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <img src="'.$path.'" alt="Girl in a jacket" width="150px" height="150px">
                                </div>
                                <div class="col-sm-9" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                <p style="font-weight: 600">'.$history->name.'</p>
                                <p> Số điện thoại: (+84)  '.$history->phone.'</p>
                            </div>';
                            }

                                $output.='
                                <h5 class="modal-title">Vị trí làm việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <p style="font-weight: 600">'.$shipping->shipping_name.'</p>
                                    <p> Số điện thoại: (+84)  '.$shipping->shipping_phone.'</p>
                                    <p> '.$shipping->shipping_address.'</p>
                                </div>
                                <h5 class="modal-title">Thông tin công việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                                    <p style="font-weight: 600">Thời gian làm việc</p>
                                    <div style="display: flex; justify-content: space-between;height:40px">
                                        <label for="">Ngày làm việc</label>
                                        <select class="check-time" style="outline: #ccc;
                                            border: 1px solid #ccc;
                                            border-radius: 5px;
                                            padding: 0px 20px;">
                                            ';

                                            foreach ($listdate as $key => $value) {
                                                $output.='
                                                <option>'.$weekday[date('l',strtotime($listdate[$key]))].', '.date('d/m/Y',strtotime($listdate[$key])).'</option>
                                                ';
                                            }
                                            $output .='
                                        </select>
                                    </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Làm trong</label>
                                        <p class="check-time">'.$book->book_time_number.' giờ, '.$book->book_time_start.' đến '.$time_end.'</p>
                                    </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Tổng số buổi</label>
                                        <p class="check-date">'.$count_date.'</p>
                                    </div>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Số buổi đã hoàn thành</label>
                                        <p class="check-date">'.$book->date_finish.'</p>
                                    </div>

                                    <p style="font-weight: 600">Chi tiết công việc</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Khối lượng công việc</label>
                                        <p class="check-g">105m<sup>2</sup></p>
                                    </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Ghi chú cho người làm</label>
                                        <p class="check-notes">'.$book->book_notes.'</p>
                                    </div>
                                </div>
                            <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Khuyễn mãi</h5>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                                        <option selected>'.$coupon_number.''.$method.'</option>
                                    </select>
                                </div>
                            </div>

                                <div style="display: flex; justify-content: space-between">
                                    <div class="col-sm-4">
                                        <h5 class="modal-title">Phương thức thanh toán</h5>
                                    </div>
                                    <form action="'.route('home.appointment.payment.online',$book->book_id ).'" method="post"  class="col-sm-8">
                                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                                        <div class="row">
                                        <div class="col-sm-6">
                                            <select class="form-select border-0" style="height: 55px;" name="payment_id">';
                                            foreach ($payment as $key => $value) {
                                                $output .=' <option selected value="'.$value->payment_id.'">'.$value->payment_method.'</option>';

                                            }
                                                $output .='
                                            </select>
                                        </div>';
                                        if ($book->book_status == 2) {
                                            if($paymentonline){

                                            $output .='
                                            <div class="col-sm-6">
                                                <a class="btn btn-primary py-3" disable style="width:100%" ><i class="tf-ion-close">Đã thanh toán</i></a>
                                            </div>
                                            </div>
                                            ';

                                            }else{
                                                $output .='
                                                <div class="col-sm-6">
                                                    <button type="submit" name="redirect"  class="btn btn-primary py-3" style="width:100%" ><i class="tf-ion-close">Thanh toán Online</i></button>
                                                </div>
                                                </div>
                                                ';

                                            }
                                        }

                                        $output .='
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                        <h4 class="modal-title book-total">'.number_format($book->book_total).'<sup>đ</sup>  </h4>
                        </div>

                        <div class="modal-footer">
                        <form>
                        <input type="hidden" name="_token" value="'.csrf_token().'" />';
                        switch ($book->book_status) {
                            case 4:
                                $output .='
                                    <button type="button"  class="btn btn-success py-3 btn-danhgia">Đánh giá</button>
                                ';
                            break;

                            case 2:
                                $output .='
                                    <button type="button"  class="btn btn-info py-3 btn-danhgia" data-book-id="'.$book->book_id.'">Đánh giá</button>
                                    <button type="button" class="btn btn-danger  py-3 btn-change-bookdefault" data-book-id="'.$book->book_id.'"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                ';
                            break;
                            case 3:
                                $output .='
                                    <button type="button"  class="btn btn-primary py-3  "><i class="tf-ion-close" aria-hidden="true">Đăng lại</i></button>
                                    ';
                                break;

                            default:
                                $output .='
                                    <button type="button" class="btn btn-danger  py-3 btn-change-bookdefault" data-book-id="'.$book->book_id.'"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                ';
                            break;
                        }
                            $output .='
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }

    public function delete(Request $request){
        $data = $request->all();
        dd($data);
    }

    public function destroy(Request $request){
        $data = $request->all();
        $book_id = $request->book_id;
        $book = Book::where('book_id',$book_id)->first();
        // dd($book);
        $history = History::where('book_id',$book_id)->first();

        if($book){
            $book->update(['book_status'=>3]);
            if($history){
                $history->update(['history_status'=>3]);
            }
            $msg = 'Hủy đơn lịch thành công!';
            $style = 'success';
        }else{
            $msg = 'Có lỗi xảy ra khi hủy đơn lịch';
            $style = 'danger';
        }
        echo $msg;
    }


    public function destroydefault(Request $request){
        $data = $request->all();
        $book_id = $request->book_id;
        $book = Book::where('book_id',$book_id)->first();
        // dd($book);
        $history = History::where('book_id',$book_id)->first();

        if($book){
            $book->update(['book_status'=>3]);
            if($history){
                $history->update(['history_status'=>3]);
            }
            $msg = 'Hủy đơn lịch thành công!';
            $style = 'success';
        }else{
            $msg = 'Có lỗi xảy ra khi hủy đơn lịch';
            $style = 'danger';
        }
        echo $msg;
    }
}
