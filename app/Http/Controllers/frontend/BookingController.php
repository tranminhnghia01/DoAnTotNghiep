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

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
    }
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
        switch ($data['payment_id']) {
            case 3:
            $this->vnpay_Payment($book_id,$history->book_total);

                break;
                case 2:
                    return $this->momo_Online($book_id,$history->book_total);
                        break;

            default:
            $msg = "Thao tác không thành công.Vui lòng thử lại sau!";
            $style ="danger";
        return redirect()->back()->with(compact('msg','style'));

                break;
        }

    }

    public function momo_Online($book_id,$book_total){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $book_total;
        $orderId = $book_id ."-". time() . "";
        $redirectUrl = "http://127.0.0.1:8000/Moon.com/dat-lich/thanks";
        $ipnUrl = "http://127.0.0.1:8000/Moon.com/Account/quan-ly-don/$book_id";
        $extraData = "";


            $requestId = time() . "";
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            // dd($signature);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
        // dd($data);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            // dd($result);
            $jsonResult = json_decode($result, true);  // decode json
        // dd($jsonResult);
        $jsonResult['redirect'] = $jsonResult['payUrl'];
            //Just a example, please check more in there
        // dd($jsonResult['payUrl']);
            return redirect()->to($jsonResult['redirect']);

            // return header('Location: ' . $jsonResult['payUrl']);

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


     public function onepay_Online(){
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

        $vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";

        // unset($_POST["virtualPaymentClientURL"]);
        // unset($_POST["SubButL"]);
        $vpc_Merchant = 'ONEPAY';
        $vpc_AccessCode = 'D67342C2';
        $vpc_MerchTxnRef = time();
        $vpc_OrderInfo = 'JSECURETEST01';
        $vpc_Amount = 100000;
        $vpc_ReturnURL = 'http://websitemoon.vn/Moon.com';
        $vpc_Version = '2';
        $vpc_Command = 'pay';
        $vpc_Locale = 'vn';
        $vpc_Currency = 'VND';
        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vpc_ReturnURL,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency,
        );


        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        ksort ($data);

        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;

        foreach($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
        }

        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
        // header("Location: ".$vpcURL);
        dd($vpcURL);

        return redirect()->to($vpcURL);

        // *******************
        // END OF MAIN PROGRAM
        // *******************


     }
}
