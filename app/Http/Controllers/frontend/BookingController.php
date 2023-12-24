<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Book;
use App\Models\City;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\History;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Shipping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function danhgia(Request $request){
        $id= Auth::id();
        $user = User::findOrFail($id);
        $data = $request->all();
        $book_id = $request->book_id;
       $output ='';
        $history = History::where('tbl_history.book_id',$book_id)
        ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')
        ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')->first();
        $path = asset('uploads/users/'. $history->image);
        // dd($history);

       $output.='<div class="modal fade" id="Modaldanhgia" tabindex="-1" aria-labelledby="ModaldanhgiaLabel" aria-modal="true" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModaldanhgiaLabel">Đánh giá và bình luận công việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">

                            <div class="row g-3">
                                <h5 class="modal-title">Người giúp việc</h5>
                                <div class="col-sm-3" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <img src="'.$path.'" alt="Girl in a jacket" width="150px" height="150px">
                                </div>
                                <div class="col-sm-9" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                <p style="font-weight: 600">'.$history->name.'</p>
                                <p> Số điện thoại: (+84)  '.$history->phone.'</p>
                            </div>
                                <h5 class="modal-title">Đánh giá: </h5>
                                <div class="rate">
                                <div class="vote">
                                    <div class="star_1 ratings_stars"><input value="1" type="radio" name="rate" hidden></div>
                                    <div class="star_2 ratings_stars"><input value="2" type="radio" name="rate" hidden></div>
                                    <div class="star_3 ratings_stars"><input value="3" type="radio" name="rate" hidden></div>
                                    <div class="star_4 ratings_stars"><input value="4" type="radio" name="rate" hidden></div>
                                    <div class="star_5 ratings_stars"><input value="5" type="radio" name="rate" hidden></div>
                                    <span class="rate-np"></span>
                                </div>
                            </div>
                                <div class="col-sm-12" style=" border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                                    <p style="font-weight: 600">Bình luận</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <textarea id="danhgia" name="comment" rows="4" class="form-control"  placehoder="Bình luận">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <form>
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="button" class="btn btn-primary  py-3 btn-danhgia-post" data-history-id="'.$history->history_id.'"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Đánh giá</i></button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;

    }

    public function post_danhgia(CommentRequest $request){
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $data = $request->all();
        // dd($data);
        $history_id = $data['history_id'];
        $history = History::find($history_id);

        if($history){
            $info_comment = [
                'history_id'=> $history_id,
                'name'=> $user->name,
                'image'=> $shipping->shipping_image,
                'comment'=> $data['comment'],
                'rate'=> $data['rate'],
            ];

            $comment = Comment::create($info_comment);

        };

    }


    public function create()
    {
        $today = Carbon::now()->format('l,d-m-Y');
        $id= Auth::id();
        $user = User::findOrFail($id);

        $city = City::all();
        $payment = Payment::all();
        $coupon = Coupon::all();

        //get shipping info
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $service = Service::all();

        return view('frontend.booking.dat-lich')->with(compact('today','shipping','payment','coupon','service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function payment_Online(Request $request , $book_id){
        $data = $request->all();
        $history = Book::where('book_id',$book_id)->first();
        // dd($history);

        //Thanh toán vnpay
        if($data['payment_id'] == 3){
            $this->vnpay_Payment($book_id,$history->book_total);
        }else{
            $msg = "Thao tác không thành công.Vui lòng thử lại sau!";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
    }





    public function vnpay_Payment($book_id,$book_total){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/Moon.com/dat-lich/thanks";
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
