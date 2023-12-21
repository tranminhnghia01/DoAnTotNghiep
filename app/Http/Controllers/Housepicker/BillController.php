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
            ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
            ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')
            ->where('housekeeper_id',$user->user_id)->get();
        return view('housekeeper.bill')->with(compact('book','user'));

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
            if($now >= $bookdetail->book_date)
            {
                $history->update($change);
                $book->update(['book_status'=> 4]);
                $msg = 'Công việc đã hoàn thành';
                $style = 'success';
            }else{
                $msg = 'Chấm công không thành công, có lỗi xảy ra! Vui lòng thử lại sau';
                $style = 'danger';
            }

        }else{
            $days= explode(",",$bookdetail->book_date);
            $checkday = $history->date_finish + $history->history_pevious_date;
            if($now == $days[$checkday])
            {
                $date_finish = $history->date_finish +1 ;
                if($date_finish < count($days) )
                {
                    $change = [
                        'date_finish'=>$date_finish,
                        'history_notes'=> $request->history_notes,
                ];

                }else{
                    $change = [
                        'date_finish'=>$date_finish,
                        'history_status'=> 4,
                        'history_notes'=> $request->history_notes,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $book_id = $data['book_id'];
        $id= Auth::id();
        $user = User::findOrFail($id);

        $history = History::where('book_id',$book_id)->where('housekeeper_id',$user->user_id)->first();
        if($history){
            $book = Book::where('book_id',$book_id)->first();
            $book->update(['book_status'=>1]);
            $new = [
                'book_id' => $history->book_id,
                'history_status' => 1,
                'housekeeper_id' => "",
                'history_pevious_date' => $history->date_finish,
            ];
            $history->update(['history_status'=>3]);
            // History::create($new);
            $msg ='Đơn lịch đã hủy thành công';
            $style ='success';
            return redirect()->route('admin.Appoin-index')->with(compact('msg','style'));
        }
    }
}
