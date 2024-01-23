<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\Book;
use App\Models\Booking_details;
use App\Models\Coupon;
use App\Models\History;
use App\Models\Housekeeper;
use App\Models\Payment;
use App\Models\PaymentOnline;
use App\Models\Shipping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

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
    public function confirm($book_id){

        $now = Carbon::now()->format('m');

        $id= Auth::id();
        $user = User::findOrFail($id);

        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->where('tbl_booking.book_id', $book_id)->first();
        $checkhisbook = History::where('book_id',$book_id)->join('tbl_housekeeper','tbl_housekeeper.housekeeper_id','tbl_history.housekeeper_id')->get();

        $housekeeper = Housekeeper::where('status',0)->get();

        $history = History::selectRaw('count(housekeeper_id) as total, housekeeper_id')->groupBy('housekeeper_id')->whereMonth('created_at', $now)->get();
        // dd($history);


        $check_day = History::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_booking_details.book_id')->where('tbl_history.history_status',2)->get();

        return view('admin.appointment.confirm')->with(compact('book','housekeeper','history','check_day','checkhisbook'));
    }

    public function post_Confirm(Request $request,$book_id){
        $housekeeper_id = $request->housekeeper_id;
        $housekeeper = Housekeeper::where('housekeeper_id',$housekeeper_id)->first();
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->where('tbl_booking.book_id', $book_id)
        ->first();
        // dd($book);

        if($book){
            $checkhis = History::latest()->where('book_id',$book_id)->first();
            // dd($checkhis);
            if($checkhis){
                $checkYoN = History::where('book_id',$book_id)->where('housekeeper_id',$housekeeper_id)->first();
                if($checkYoN){
                    $checkhis->update(['history_status'=>2]);
                    $msg = "Giao lại công việc cho người giúp việc này!";
                    $style = "success";
                }else{
                    $info = [
                        'book_id' => $checkhis->book_id,
                        'history_status' => 2,
                        'housekeeper_id' => $housekeeper_id,
                        'history_previous_date' => $checkhis->date_finish + $checkhis->history_previous_date ,
                    ];
                    // dd($info);
                $history = History::create($info);
                }

            }else{
                $info = [
                    'book_id' => $book_id,
                    'housekeeper_id' => $housekeeper_id,
                    'history_status'=> 2,
                ];
                $history = History::create($info);

            }

            if ($history) {
                $bookupdate = Book::where('book_id',$book_id)->first();
                $bookupdate->update(['book_status'=>2]);
                Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($book));
                $msg = "Đã giao công việc thành công";
                $style = "success";

            }else{
                $msg = "Có lỗi xảy ra. Vui lòng kiểm tra lại!";
                    $style = "danger";
            };
        };
        return redirect()->route('admin.appointment.index')->with(compact('msg','style'));
    }

    public function fast_Show(Request $request){
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
        $check = History::where('book_id',$book_id)->get();
        $count = (count($check));
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
        for ($i=0; $i < $count_date; $i++) {
            $changedate = explode("/", $listdate[$i]);
                $listdate[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
        }

        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];

        //check thanh toán
        $now = Carbon::now()->format('m/d/Y');
        $hours_now =  Carbon::now()->format('H');
        // dd($hours_now);15
        $checkhours = $split_time[0] - 2;
        // dd($checkhours);
        // dd($now);
        // dd($listdate[0]);
        $check_payment = true;
        if($book->service_id == 2 && $book->payment_id == 1){
            if($listdate[0] == $now && $hours_now > $checkhours ){
                $check_payment = false;
            }else{
                $check_payment = true;

            }
        }


        $output.='
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">
                            <div class="row g-3">';
                                if ($history && $count <= 2) {
                                    $path = asset('uploads/users/'. $history->image);

                                    $output.='
                                    <h5 class="modal-title">Người giúp việc</h5>
                                <div class="row" style="border: 1px solid #ccc; border-radius: 5px; margin: 1px; padding: 5px;">
                            <div class="col-sm-3">
                            <img src="'.$path.'" alt="Girl in a jacket" width="150px" height="150px">
                        </div>
                        <div class="col-sm-9">
                        <p style="font-weight: 600">'.$history->name.'</p>
                        <p> Số điện thoại: (+84)  '.$history->phone.'</p>
                            </div>

                            </div>';
                            if($history->history_notes && $count <= 2){
                                $output.='<p style="color: "> Ghi chú: '.$history->history_notes.' </p>';
                            };
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
                                    <div style="display: flex; justify-content: space-between;height:40px">
                                        <label for="">Ngày làm việc</label>
                                        <select class="check-time" style="outline: #ccc;
                                            border: 1px solid #ccc;
                                            border-radius: 5px;
                                            padding: 0px 20px;">
                                            ';
                                            foreach ($listdate as $key => $value) {
                                                $output.='
                                                <option>'.$weekday[date('l',strtotime($listdate[$key]))].', '.date('d/m/Y',strtotime($listdate[$key])).'</option>
                                                ';
                                            }
                                            $output .='
                                        </select>
                                    </div>
                                    <div style="display: flex; justify-content: space-between">
                                            <label for="">Làm trong</label>
                                            <p class="check-time">'.$book->book_time_number.' giờ, '.$book->book_time_start.' đến '.$time_end.'</p>
                                        </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <label for="">Tổng số buổi</label>
                                        <p class="check-date">'.$count_date.'</p>
                                    </div>
                                    ';
                                    if($history && $count <= 2){
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
                            $output .='
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }

    public function show(Request $request, $history_id){
         // dd($book_id);
         $id= Auth::id();
        $user = User::findOrFail($id);

        $history = History::where('history_id',$history_id)->join('tbl_housekeeper', 'tbl_housekeeper.housekeeper_id', '=', 'tbl_history.housekeeper_id')
                ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_history.book_id')
                ->join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking.payment_id')->first();

        $paymentonline = PaymentOnline::where('TxnRef',$history->book_id)->first();


        $coupon = Coupon::find($history->coupon_id);
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

        $listdate= explode(",",$history['book_date']);
         $count_date= count($listdate);
        // dd($count_date);
        for ($i=0; $i < $count_date; $i++) {
            $changedate = explode("/", $listdate[$i]);
             $listdate[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
            $timestamp = strtotime( $listdate[$i]);

        }

        $shipping = Shipping::where('shipping_id', $history->shipping_id)->first();

        // dd($history);
        $split_time = explode(":",$history->book_time_start);
        $time_end = $split_time[0]+$history->book_time_number .':'.$split_time[1];

        return view('admin.appointment.details-single')->with(compact('time_end','listdate','method','coupon_number','history','shipping','paymentonline','user'));


    }

    public function search_confirm(Request $request){

        $data = $request->all();
        $keywords = $data['keywords'];
        $gender = $data['gender'];
        $age_start = $data['age_start'];
        $age_end = $data['age_end'];
        $output = '';
        $book_id = $data['book_id'];
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->where('tbl_booking.book_id', $book_id)->first();

        $now = Carbon::now()->format('m');
        $history = History::selectRaw('count(housekeeper_id) as total, housekeeper_id')->groupBy('housekeeper_id')->whereMonth('created_at', $now)->get();

        if($gender){
            $house = Housekeeper::where('name','LIKE','%'.$keywords.'%')
        ->where('age','>=',$age_start)
        ->where('age','<=',$age_end)
        ->where('gender',$gender)
        ->where('status',0)
        ->get();
        }else{
            $house = Housekeeper::where('name','LIKE','%'.$keywords.'%')
        ->where('age','>=',$age_start)
        ->where('age','<=',$age_end)
        ->where('status',0)
        ->get();
        }
        // dd($house);
        $check_day = History::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_history.book_id')
        ->join('tbl_booking', 'tbl_booking.book_id', '=', 'tbl_booking_details.book_id')->where('tbl_history.history_status',2)->get();
        if($house){
            $status = [];
            foreach ($house as $key => $value) {
                $status[$key] = 0;
                $checkday =0 ;
                $total = 0;
                foreach ($check_day as $check => $valcheck){
                    $datecheck =  explode(",",$valcheck->book_date);
                    $date =  explode(",",$book->book_date);
                    // dd($date);

                    if ($valcheck->housekeeper_id == $value->housekeeper_id){
                        for ($i = 0; $i < count($date); $i++){
                            if(in_array($date[$i], $datecheck)){
                                 $status[$key] = 1;
                            }
                        }
                    }
                }
                if($value->gender == 1){
                    $type = 'Nam';
                }else{
                    $type = "Nữ";
                }

                $output.='<tr>
                <td>'.$key.'</td>
                <td>'.$value->housekeeper_id.'</td>
                <td>'.$value->name.'</td>
                <td>'.$type.'</td>
                <td>'.$value->age.'</td>';

                foreach ($history as $keyt => $valt) {
                    if ($valt->housekeeper_id == $value->housekeeper_id)
                    {
                        $checkday = 1 ;
                        $total = $valt->total;
                    }else{
                        $checkday = 0 ;

                    }
                }

                if ($total != 0)
                {
                    $output.='<td style="color: green">'.$total.'</td>';
                }else{
                    $output.='<td style="color: red">'.$total.'</td>';
                }
                // dd($status);
                if ($status[$key] == 1){
                    $output.='<td><span style="color: red">Trùng lịch</span></td>
                    <td><button class="btn btn-default">Giao công việc</button></td>';
                }else{
                    $output.='
                    <td><span style="color: green"> Không trùng lịch</span></td>
                    <td>
                        <form action="'.route('admin.appointment.post-confirm',$book->book_id ).'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="housekeeper_id" value="'.$value->housekeeper_id.'">
                            <button type="submit" class="btn btn-primary" data-id="'.$value->housekeeper_id.'"> Giao công việc</button>
                        </form>
                    </td>';
                }
                $output.='
                <td><a href="'.route('admin.housekeeper.show',$value->housekeeper_id).'" class="btn btn-default">Xem chi tiết </a></td>';
            };

        };
        echo ($output);
    }
}
