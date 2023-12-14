<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\Book;
use App\Models\Booking_details;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_Cale()
    {
        $service = Service::find(1);
        return view('frontend.service.ca-le.index')->with(compact('service'));

    }

    public function index_Codinh()
    {
        $service = Service::find(2);
        return view('frontend.service.co-dinh.index')->with(compact('service'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_Cale()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $city = City::all();
        $payment = Payment::all();
        $coupon = Coupon::all();

        //get shipping info
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $service = Service::find(1);

        return view('frontend.service.ca-le.create')->with(compact('shipping','payment','coupon','service'));
    }

    public function create_Codinh()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $city = City::all();
        $payment = Payment::all();
        $coupon = Coupon::all();

        //get shipping info
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $service = Service::find(2);

        return view('frontend.service.co-dinh.create')->with(compact('shipping','payment','coupon','service'));
    }


    public function store(Request $request){


        $data = $request->all();
        // dd($data);
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $book_id = substr(md5(microtime()),rand(0,26),5);
        $book_date = $request->book_date;

        if($data['service_id'] == 1){
            $book_options = $request->list_options;
        }else{
            $book_options = "";
        };

        $coupon_id = explode(',',$data['coupon_id']);

        $book_total =$data['book_total'];
        // dd($shipping);

        $total_coupon = 0;
        $coupon = Coupon::find($coupon_id[0]);
        if($coupon){
            if ($coupon->coupon_method == 0) {
                $total_coupon = $book_total*$coupon->coupon_number/100;
            }else{
                $total_coupon = $coupon->coupon_number;
            }
        };
        $book_total = $book_total - $total_coupon;

            $booking = [
                'book_id'=>$book_id,
                'service_id'=>$data['service_id'],
                'shipping_id'=> $shipping->shipping_id,
                'book_total'=>$book_total,
                'book_status'=>1,
                'book_address'=>$shipping->shipping_address,
                'book_notes'=>$data['book_notes'],
            ];
            $booking = Book::create($booking);

            if($booking){
                $booking_details = [
                    'book_id'=>$booking->book_id,
                    'coupon_id'=>$coupon_id[0],
                    'payment_id'=>$data['payment_id'],
                    'book_date'=>$data['book_date'],
                    'book_time_start'=>$data['book_time_start'],
                    'book_time_number'=>$data['book_time_number'],
                    'book_total'=>$booking->book_total,
                    'book_options'=> $book_options,
                ];

                $bookdetail = Booking_details::create($booking_details);
                if($bookdetail->coupon_id == 0){
                    $email = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                    ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                    ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                    ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking_details.payment_id')
                    ->where('tbl_booking.book_id',$booking->book_id)->first();
                }else{
                    $email = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                    ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                    ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                    ->join('tbl_coupon', 'tbl_coupon.coupon_id', '=', 'tbl_booking_details.coupon_id')
                    ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking_details.payment_id')
                    ->where('tbl_booking.book_id',$booking->book_id)->first();
                }


                    //Gửi mails
                    Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($email));

                    /// Thanh toán vnpay
                    if($data['payment_id'] == 3){
                        $this->vnpay_Payment($booking->book_id,$booking->book_total);
                    }

                $msg = 'Đặt đơn lịch thành công.';
                $style = 'success';
                return redirect()->route('home.thanks')->with(compact('msg','style'));

            }

        $msg = 'Có lỗi xảy ra khi đặt lịch! Vui lòng kiểm tra lại.';
        $style = 'danger';
        return redirect()->back()->with(compact('msg','style'));
    }

    public function check_Booking(Request $request){
        $data = $request->all();
        $weekday = [
            'Monday' => 'Thứ 2',
            'Tuesday' => 'Thứ 3',
            'Wednesday' => 'Thứ 4',
            'Thursday' => 'Thứ 5',
            'Friday' => 'Thứ 6',
            'Saturday' => 'Thứ 7',
            'Sunday' => 'Chủ nhật',
        ];
        $book_time_start = $data['book_time_start'];
        $book_price = $data['book_price'];


        $book_time_number = $data['book_time_number'];


        $total = 0;

        $klcv = $data['Klcv'];
        $book_notes = $data['book_notes'];
        $service_id = $data['service_id'];

        // Tổng ngày
        $data['book_date']= explode(",",$data['book_date']);
         $count_date= (count($data['book_date']));

        //  tính tổng (tiền từng ngày) T CN tang 10000
        for ($i=0; $i < $count_date; $i++) {
            $changedate = explode("/",$data['book_date'][$i]);
            $data['book_date'][$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
            $timestamp = strtotime($data['book_date'][$i]);
            $getday = date('l',$timestamp);
            // $data['VN'][$i] = $weekday[$getday];
            if($getday == "Sunday" || $getday =="Saturday"){
                $total += ($book_price+10000)*$book_time_number;
            }else{
                $total += $book_price*$book_time_number;
            }
        }

        $data['book_options'] = $request->book_options;
        if($data['book_options']){
            foreach ($data['book_options'] as $key => $value) {
                if ($value == "Mang dụng cụ") {
                    $total += 30000;
                }
            }
            $data['book_options']=implode(",",$data['book_options']);
        }
        if($service_id == 2){
            if($book_time_number > 2){
                $book_price = $book_price-10000;
            }
        };

        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();

        $payment = Payment::all();
        $coupon = Coupon::all();
        $split_time = explode(":",$book_time_start);
        $time_end = $split_time[0]+$book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <p><a href="'.route('home.checkout').'" class="btn btn-success" style="float: right">Thay đổi</a></p>
                        </div>
                        <h5 class="modal-title">Thông tin công việc</h5>
                        <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                            <p style="font-weight: 600">Thời gian làm việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ngày bắt đầu làm việc</label>
                                <p class="check-date">'.$weekday[date('l',strtotime($data['book_date'][0]))].', '.date('d/m/Y',strtotime($data['book_date'][0])).'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ngày kết thúc làm việc</label>
                                <p class="check-date">'.$weekday[date('l',strtotime($data['book_date'][$count_date-1]))].', '.date('d/m/Y',strtotime($data['book_date'][$count_date-1])).'</p>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <label for="">Làm trong</label>
                                <p class="check-time">'.$book_time_number.' giờ, '.$book_time_start.' đến '.$time_end.'</p>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <label for="">Số buổi</label>
                                <p class="check-date">'.$count_date.'</p>
                            </div>

                            <p style="font-weight: 600">Chi tiết công việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Khối lượng công việc</label>
                                <p class="check-g">'.$klcv.'</p>
                            </div>';

                            if ($service_id ==1) {
                                $output.='
                                <div style="display: flex; justify-content: space-between">
                                <label for="">Dịch vụ thêm</label>
                                <input type="hidden" name"book_optionss" value="'.$data['book_options'].'">
                                <p id="options" class="check-options">'.$data['book_options'].'</p>
                            </div>';
                            }

                            $output.='
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ghi chú cho người làm</label>
                                <p class="check-notes">'.$book_notes.'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Phương thức thanh toán</h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Khuyễn mãi</h5>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                <select class="form-select border-0" style="height: 55px;" name="payment_id">';
                                foreach ($payment as $key => $valP) {
                                    if ($service_id == 2 && $key != 0) {
                                        $output .=' <option value="'.$valP->payment_id.'">'.$valP->payment_method.'</option>';
                                    }
                                    if ($service_id == 1) {
                                        $output .=' <option value="'.$valP->payment_id.'">'.$valP->payment_method.'</option>';
                                    }
                                }
                                 $output .='
                                </select>
                                </div>
                                <div class="col-sm-6">
                                <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                            <option selected  value="0,0,0">Khuyễn mãi</option>';
                            foreach ($coupon as $key => $valC) {
                                $time_end = date('d/m/Y',strtotime($valC->coupon_time_end));
                                $today = date('d/m/Y',strtotime(now()));
                                $output .=' <option value="'. $valC->coupon_id .','. $valC->coupon_method .','. $valC->coupon_number .'" ';
                                if ( ($time_end <= $today)) {
                                    $output.='disabled style="color: red"';
                                }
                                $output.='>'. $valC->coupon_name.'</option>';
                            }
                             $output .='

                        </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                            <h4 class="modal-title book-total">'.number_format($total).'đ</h4>
                            <input type="hidden" name="book_total" value="'.$total.'">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="redirect" class="btn btn-orange w-100 py-3">Đặt lịch</button>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }


    public function vnpay_Payment($book_id,$book_total){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/Moon.com/thanks";
        $vnp_TmnCode = "KETREN3N";//Mã website tại VNPAY
        $vnp_HashSecret = "EVZTCKKWRQVUHMPECQCXZLPRAVYCPSJO"; //Chuỗi bí mật

        $vnp_TxnRef = $book_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn đặt lịch';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int) $book_total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
     }
}
