<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking_details;
use App\Models\PaymentOnline;
use App\Models\Province;
use App\Models\Statistic;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
// session_start();


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function thanks(Request $request){
        $data = $request->all();


       if(isset($_GET['vnp_Amount'])){

            $data = [
                'Amount'=> $_GET['vnp_Amount'],
                'BankCode'=> $_GET['vnp_BankCode'],
                'BankTranNo'=> $_GET['vnp_BankTranNo'],
                'CardType'=> $_GET['vnp_CardType'],
                'OrderInfo'=> $_GET['vnp_OrderInfo'],
                'PayDate'=> $_GET['vnp_PayDate'],
                'ResponseCode'=> $_GET['vnp_ResponseCode'],
                'TmnCode'=> $_GET['vnp_TmnCode'],
                'TransactionNo'=> $_GET['vnp_TransactionNo'],
                'TransactionStatus'=> $_GET['vnp_TransactionStatus'],
                'TxnRef'=> $_GET['vnp_TxnRef'],
                'SecureHash'=> $_GET['vnp_SecureHash'],
            ];
        $book= Book::where('book_id',$_GET['vnp_TxnRef'])->first();

            $paymentOnline = PaymentOnline::create($data);
            if($paymentOnline){
                $book= Book::where('book_id',$_GET['vnp_TxnRef'])->first();
                $book->update(['payment_id'=>3]);

                $now = Carbon::now()->format('Y-m-d');
                $update_statistical = Statistic::where('date' ,$now)->first();
                // dd($update_statistical);
                if($update_statistical){
                    $info_static = [
                        'sales' => $update_statistical->sales + ($paymentOnline->Amount)/100,
                        'profit' => $update_statistical->profit + ($paymentOnline->Amount)/1000,
                        'total_appointment'=> $update_statistical->total_appointment + 1,
                    ];
                    $update_statistical->update($info_static);
                }else{
                    $info_static = [
                        'date' => $now,
                        'sales' => ($paymentOnline->Amount)/100,
                        'profit' => ($paymentOnline->Amount)/1000,
                        'total_appointment'=> 1,
                    ];
                    Statistic::create($info_static);
                }
            }
        }


        if(isset($_GET['paymentOption']) == 'momo'){
            $order_data = explode('-',$_GET['orderId']);
            $order_id =$order_data[0];
            // dd($order_id);
            $data = [
                'Amount'=> $_GET['amount'],
                'BankCode'=> $_GET['paymentOption'],
                'BankTranNo'=> $_GET['requestId'],
                'CardType'=> $_GET['payType'],
                'OrderInfo'=> $_GET['orderInfo'],
                'PayDate'=> $_GET['responseTime'],
                'ResponseCode'=> $_GET['resultCode'],
                'TmnCode'=> $_GET['partnerCode'],
                'TransactionNo'=> $_GET['transId'],
                'TransactionStatus'=> $_GET['message'],
                'TxnRef'=> $order_id,
                'SecureHash'=> $_GET['signature'],
            ];
            // dd($data);
            $book= Book::where('book_id',$order_id)->first();

            $paymentOnline = PaymentOnline::create($data);
            if($paymentOnline){
                $book->update(['payment_id'=>2]);

                $now = Carbon::now()->format('Y-m-d');
                $update_statistical = Statistic::where('date' ,$now)->first();
                // dd($update_statistical);
                if($update_statistical){
                    $info_static = [
                        'sales' => $update_statistical->sales + ($paymentOnline->Amount),
                        'profit' => $update_statistical->profit + ($paymentOnline->Amount)/10,
                        'total_appointment'=> $update_statistical->total_appointment + 1,
                    ];
                    $update_statistical->update($info_static);
                }else{
                    $info_static = [
                        'date' => $now,
                        'sales' => ($paymentOnline->Amount),
                        'profit' => ($paymentOnline->Amount)/10,
                        'total_appointment'=> 1,
                    ];
                    Statistic::create($info_static);
                }
            }
        }
        $msg = 'Giao dịch thành công';
        $style ="success";
        return view('frontend.thanks')->with(compact('msg','style'));
    }


    public function index()
    {
        $user = Auth::user();
        return view('admin.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function select_address(Request $request) {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('city_id',$data['ma_id'])->orderby('province_id','ASC')->get();
                    $output.='<option>chọn Tỉnh...</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->province_id.'">'."$province->province_name".'</option>';
                }

            }else{
                $select_wards = Ward::where('province_id',$data['ma_id'])->orderby('ward_id','ASC')->get();
                $output.='<option>Phường/Xã...</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
            echo $output;
        }
    }

}
