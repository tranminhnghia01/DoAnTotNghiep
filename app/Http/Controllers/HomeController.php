<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking_details;
use App\Models\PaymentOnline;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
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
            PaymentOnline::create($data);
            $book= Book::where('book_id',$_GET['vnp_TxnRef'])->first();
            $book->update(['payment_id'=>3]);
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
