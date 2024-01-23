<?php

namespace App\Http\Controllers\Housepicker;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking_details;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
            ->where('processing',1)
            ->where('housekeeper_id',$user->user_id)
            ->whereBetween('tbl_history.history_status', [3, 4])
            ->get();
        return view('housekeeper.bill')->with(compact('book','user'));

        // dd($book);
    }

    public function index_processing()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
            ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
            ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')
            ->where('processing',0)
            ->where('housekeeper_id',$user->user_id)
            ->whereBetween('tbl_history.history_status', [3, 4])
            ->get();
        return view('housekeeper.bill-processing')->with(compact('book','user'));

        // dd($book);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ChamCong(Request $request,$book_id)
    {
        // dd($request->all());
        $id= Auth::id();
        $user = User::findOrFail($id);

        $history = History::where('book_id',$book_id)->where('housekeeper_id',$user->user_id)->first();
        $book = Book::where('book_id',$book_id)->first();
        $bookdetail = Booking_details::where('book_id',$book_id)->first();
        $now = Carbon::now()->format('d/m/Y');

        if($book->service_id == 1){
            $change = [
                'date_finish'=>1,
                'history_status'=> 4,
                'history_notes'=> $request->history_notes,
            ];

                $history->update($change);
                $book->update(['book_status'=> 4]);
                $msg = 'Công việc đã hoàn thành';
                $style = 'success';

        }else{
            $days= explode(",",$bookdetail->book_date);
            $checkday = $history->date_finish + $history->history_previous_date;
            if($now == $days[$checkday])
            {
                $date_finish = $history->date_finish +1 ;
                // dd(count($days));

                if($date_finish + $history->history_previous_date < count($days) )
                {
                    $change = [
                        'date_finish'=>$date_finish,
                        'history_notes'=> ($history->history_notes."-".$request->history_notes),
                ];

                }else{
                    $change = [
                        'date_finish'=>$date_finish,
                        'history_status'=> 4,
                        'history_notes'=> ($history->history_notes."-".$request->history_notes),
                    ];
                    $book->update(['book_status'=> 4]);
                }
                $history->update($change);
                $msg = 'Công việc hôm nay đã hoàn thành';
                $style = 'success';
            }else
            {
                $msg = 'Có lỗi xảy ra! Vui lòng kiểm tra lại công việc hôm nay';
                $style = 'danger';
            }
        }
        return redirect()->back()->with(compact('msg','style'));


    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $history_id = $data['history_id'];
        $id= Auth::id();
        $user = User::findOrFail($id);

        $history = History::where('history_id',$history_id)->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')->first();

        if($history){
            $book = Book::where('book_id',$history->book_id)->first();
            if($history->payment_id == 1 && $history->service_id == 2){
                $book->update(['book_status'=>3,'book_notes'=>"Hủy do khách hàng chưa thanh toán"]);
                $history->delete();
                $msg ='Đơn lịch đã hủy thành công, do khách hàng không thanh toán trong thời gian quy định';
                $style ='success';
                return redirect()->route('admin.Appoin-index')->with(compact('msg','style'));

            }else{
                $book->update(['book_status'=>1]);
                if($history->date_finish == 0){
                        $history->delete();
                }else{
                     $history->update(['history_status'=>4,'history_notes'=>$data['history_notes']]);
                }

                // History::create($new);
                $msg ='Hủy thành công, Đơn lịch này sẽ được quản trị viên xử lý lại';
                $style ='success';
                return redirect()->route('admin.Appoin-index')->with(compact('msg','style'));
            }
        }
    }
}
