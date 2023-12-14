<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Coupon;
use App\Models\History;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->orderBy('tbl_booking.created_at', 'desc')->get();

        $bill = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
                ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
                ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
                ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
                ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
                ->orderBy('tbl_booking.created_at', 'desc')->get();

        return view('admin.appointment.index')->with(compact('book','user','bill'));
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
    public function show(Request $request){
        // dd($request->action);
        $book_id = $request->book_id;
        $weekday = [
            'Monday' => 'Thứ 2',
            'Tuesday' => 'Thứ 3',
            'Wednesday' => 'Thứ 4',
            'Thursday' => 'Thứ 5',
            'Friday' => 'Thứ 6',
            'Saturday' => 'Thứ 7',
            'Sunday' => 'Chủ nhật',
        ];
        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->orderBy('tbl_booking.created_at', 'desc')
        ->where('tbl_booking.book_id',$book_id)->first();
        $history = History::join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
        ->where('tbl_history.book_id',$book_id)->first();

        // dd($book);
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

        $listdate= explode(",",$book['book_date']);
         $count_date= count($listdate);
        // dd($count_date);
            for ($i=0; $i < $count_date; $i++) {
                $changedate = explode("/", $listdate[$i]);
                 $listdate[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
            }

        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
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
                            <div class="row" style="border: 1px solid #ccc;
                            border-radius: 5px;
                            margin: 1px;
                            padding: 5px;">
                            <div class="col-sm-3">
                            <img src="'.$path.'" alt="Girl in a jacket" width="150px" height="150px">
                        </div>
                        <div class="col-sm-9">
                        <p style="font-weight: 600">'.$history->name.'</p>
                        <p> Số điện thoại: (+84)  '.$history->phone.'</p>
                            </div>

                            </div>';
                            }

                                $output.='
                                <h5 class="modal-title">Vị trí làm việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <p style="font-weight: 600">'.$book->shipping_name.'</p>
                                    <p> Số điện thoại: (+84)  '.$book->shipping_phone.'</p>
                                    <p> '.$book->shipping_address.'</p>
                                </div>
                                <h5 class="modal-title">Thông tin công việc</h5>
                                <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                                    <p style="font-weight: 600">Thời gian làm việc</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Ngày bắt đầu làm việc</label>
                                        <p class="check-date">'.$weekday[date('l',strtotime($listdate[0]))].', '.date('d/m/Y',strtotime($listdate[0])).'</p>
                                    </div>



                                    ';
                                    if($book->service_id == 2){
                                        $output.='
                                        <div style="display: flex; justify-content: space-between">
                                        <label for="">Ngày kết thúc làm việc</label>
                                        <p class="check-date">'.$weekday[date('l',strtotime($listdate[$count_date-1]))].', '.date('d/m/Y',strtotime($listdate[$count_date-1])).'</p>
                                    </div>
                                        ';
                                    }

                                    $output.='
                                    <div style="display: flex; justify-content: space-between">
                                            <label for="">Làm trong</label>
                                            <p class="check-time">'.$book->book_time_number.' giờ, '.$book->book_time_start.' đến '.$time_end.'</p>
                                        </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Tổng số buổi</label>
                                        <p class="check-date">'.$count_date.'</p>
                                    </div>
                                    ';
                                    if($history){
                                        $output.='
                                            <div style="display: flex; justify-content: space-between">
                                                <label for="">Số buổi đã hoàn thành</label>
                                                <p class="check-date">'.$history->date_finish.'</p>
                                            </div>';
                                    }

                                    $output.='
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
                                <div class="col-12 col-sm-6">
                                    <h5 class="modal-title">Phương thức thanh toán</h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5 class="modal-title">Khuyến mãi</h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p class="form-control border-0 bg-light" style="height: 55px;color:#000">'.$payment->payment_method.'</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p class="form-control border-0 bg-light" style="height: 55px;color:#000">'.$coupon_number.''.$method.'</p>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                        <h4 class="modal-title book-total">'.number_format($book->book_total).'<sup>đ</sup>  </h4>
                        </div>

                        <div class="modal-footer">
                        <form>
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                        <button type="button" class="btn btn-secondary py-3" data-bs-dismiss="modal"  style="width:150px">Close</button>

                        ';
                        if ($request->action == "book_cance") {
                                $output .='
                                <button type="button" class="btn btn-danger  py-3 btn-change-bookdefault" data-book-id="'.$book->book_id.'"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>

                           ';
                        }
                            $output .='
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
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
    public function destroy($id)
    {
        //
    }
}
