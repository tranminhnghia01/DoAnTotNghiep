<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
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
        if($history->history_status == 4){
            if($history->payment_id == 1){
                $now = Carbon::now()->format('Y-m-d');
                $update_statistical = Statistic::where('date' ,$now)->first();
                if($update_statistical){
                    $info_static = [
                        'sales' => $update_statistical->sales + $history->book_total,
                        'profit' => $update_statistical->profit + $history->book_total*0.1,
                        'total_appointment'=> $update_statistical->total_appointment + 1,
                    ];
                    dd($info_static);
                    $update_statistical->update($info_static);
                }else{
                    $info_static = [
                        'date' => $now,
                        'sales' => $history->book_total,
                        'profit' => $history->book_total*0.1,
                        'total_appointment'=> 1,
                    ];
                    dd($info_static);
                    Statistic::create($info_static);
                };
            }
            $history->update(['processing'=>0]);

        }elseif($history->history_status == 3){
            dd($history);
        }
    }

    public function hoadon_processing(){
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
                ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
                ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                ->whereBetween('tbl_history.history_status', [3, 4])
                ->where('processing',0)
                ->orderBy('tbl_booking.created_at', 'desc')
                ->get();
        $bill = PaymentOnline::all();

        // dd($book);
        return view('admin.appointment.billprocessing')->with(compact('book','user','bill'));
    }

}
