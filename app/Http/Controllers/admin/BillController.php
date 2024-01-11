<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking_details;
use App\Models\History;
use App\Models\Payment;
use App\Models\PaymentOnline;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
                ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
                ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                ->whereBetween('tbl_history.history_status', [3, 4])
                ->where('processing', 1)
                ->orderBy('tbl_booking.created_at', 'desc')
                ->get();
        $bill = PaymentOnline::all();

        // dd($book);
        return view('admin.appointment.bill')->with(compact('book','user','bill'));
    }

    public function index_handle($history_id){
        $history = History::join('tbl_booking','tbl_booking.book_id','=','tbl_history.book_id')
        ->where('tbl_history.history_id',$history_id)->first();
        // dd($history);
        $now = Carbon::now()->format('Y-m-d');
        // $now = '2023-12-25';
        $update_statistical = Statistic::where('date' ,$now)->first();


        $bookdetails = Booking_details::where('book_id',$history->book_id)->first();
        if($history->history_status == 4){
            if($history->payment_id == 1){
                if($update_statistical){
                    $info_static = [
                        'sales' => $update_statistical->sales + $history->book_total,
                        'profit' => $update_statistical->profit + $history->book_total*0.1,
                        'total_appointment'=> $update_statistical->total_appointment + 1,
                    ];
                    // dd($info_static);
                    $update_statistical->update($info_static);
                }
                else{
                    $info_static = [
                        'date' => $now,
                        'sales' => $history->book_total,
                        'profit' => $history->book_total*0.1,
                        'total_appointment'=> 1,
                    ];
                    // dd($info_static);
                    Statistic::create($info_static);
                };
            }
            $history->update(['processing'=>0]);

        }elseif($history->history_status == 3){
            if($history->payment_id != 1){
            // dd($bookdetails);
                $listdate= explode(",",$bookdetails->book_date);
                $count_date= count($listdate);
                $total_price =0;
                $profit =0;

                if($history->service_id == 1){
                    // dd('hoàn tiền ca lẻ');
                    $total_price = $history->book_total;
                    //Tiền hoàn trả
                    $total_refund = $history->book_total*0.8;
                    //Lợi nhuận mình đc
                    $profit =$total_price- $total_refund;
                }else{
                    // dd('hoàn tiền ca cố định');
                    //Tiền chưa làm
                    $total_price =$history->book_total / $count_date * ($count_date-$history->date_finish - $history->history_previous_date);
                    //Tiền hoàn trả
                    // $total_refund = $history->book_total* (1 - 1/$count_date * ($history->date_finish + $history->history_previous_date) - 0.2);
                    $total_refund = $total_price* 0.8;

                    //Lợi nhuận mình đc
                    $profit =$total_price- $total_refund;
                }

                if($update_statistical){
                    $info_static = [
                        'sales' => $update_statistical->sales - $total_refund,
                        'profit' => $update_statistical->profit + $profit,
                    ];
                    // dd($info_static);

                    $update_statistical->update($info_static);
                }else{
                    $info_static = [
                        'date' => $now,
                        'sales' => -$total_refund,
                        'profit' => $profit,
                        'total_appointment'=> 0,
                    ];
                    // dd($info_static);
                    Statistic::create($info_static);
                };
            $history->update(['processing'=>0,'history_refund'=>$total_refund]);
            }
        }

        $msg = "Duyệt hóa đơn thành công";
        $style = "success";
        return redirect()->back()->with(compact('msg','style'));

    }

    public function hoadon_processing(){
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::where('processing',0)
                ->orderBy('updated_at', 'desc')
                ->get();
        $bill = PaymentOnline::all();

        // dd($book);
        return view('admin.appointment.billprocessing')->with(compact('book','user','bill'));
    }

}
