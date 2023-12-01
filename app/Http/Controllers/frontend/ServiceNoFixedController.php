<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Booking_details;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Shipping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ServiceNoFixedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::find(1);
        return view('frontend.service.ca-le')->with(compact('service'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('frontend.booking.appointment')->with(compact('today','shipping','payment','coupon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check_Booking(Request $request){
        $data = $request->all();
        $book_time_start = $request->book_time_start;
        $book_time_number = $request->book_time_number;
        $klcv = $request->klvc;
        $book_notes = $request->book_notes;
        $timestamp = strtotime($data['book_date']);
        $book_date = date('l,d-m-Y',$timestamp);
        // dd(implode(",",$data['book_options']));
        $output = '';
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();

        $payment = Payment::all();
        $coupon = Coupon::all();
        // if($coupon == true){
        //     $coupon_number = $coupon->coupon_number;
        //     if($coupon->coupon_method == 0){
        //         $method = '%';
        //     }else{
        //         $method = 'đ';
        //     }
        // }else{
        //     $coupon_number = '';
        //     $method = '';
        // }
        $price = 80000;
        $split_time = explode(":",$book_time_start);
        $time_end = $split_time[0]+$book_time_number .':'.$split_time[1];
        $output.='<div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;padding-left: 0px">
                <div class="modal-dialog">
                    <div class="bg-white modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #000;">

                        <div class="row g-3">
                        <h5 class="modal-title">Vị trí làm việc</h5>
                        <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                            <p style="font-weight: 600">{{ $shipping->shipping_name }}</p>
                            <p> Số điện thoại: (+84)  {{ $shipping->shipping_phone }}</p>
                            <p>{{ $shipping->shipping_address }} <br> <a href="'.route('home.checkout').'" class="btn btn-success" style="float: right">Thay đổi</a></p>
                        </div>
                        <h5 class="modal-title">Thông tin công việc</h5>
                        <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                            <p style="font-weight: 600">Thời gian làm việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ngày làm việc</label>
                                <p class="check-date">'.$book_date.' - '.$book_time_start.'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Làm trong</label>
                                <p class="check-time">'.$book_time_number.' giờ, '.$book_time_start.' đến '.$time_end.'</p>
                            </div>

                            <p style="font-weight: 600">Chi tiết công việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Khối lượng công việc</label>
                                <p class="check-g">'.$klcv.'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Dịch vụ thêm</label>
                                <p id="options" class="check-options">'.implode(",",$data['book_options']).'</p>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ghi chú cho người làm</label>
                                <p class="check-notes">'.$book_time_number*$price.'</p>
                            </div>
                        </div>


                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary py-3">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }

    public function store(BookRequest $request)
    {
        $data = $request->all();
        $id= Auth::id();
        $user = User::findOrFail($id);
        $shipping = Shipping::where('user_id', $user->user_id)->first();
        $book_id = substr(md5(microtime()),rand(0,26),5);
        $coupon_id = explode(',',$data['coupon_id']);


        // dd($data);
        $booking = [
            'book_id'=>$book_id,
            'service_id'=>$data['service_id'],
            'shipping_id'=> $shipping->shipping_id,
            'book_total'=>$data['book_total'],
            'book_status'=>1,
            'book_address'=>$shipping->shipping_address,
            'book_notes'=>$data['book_notes'],
        ];

        // $booking = Book::create($booking);
        $booking = Book::find(1);
        // dd($booking);

        if($booking){
            if ($data['options']) {
                $data['options'] =implode(",",$data['options']);
            }
            $booking_details = [
                'book_id'=>$booking->book_id,
                'coupon_id'=>$coupon_id[0],
                'payment_id'=>$data['payment_id'],
                'book_date'=>$data['book_date'],
                'book_time_start'=>$data['book_time_start'],
                'book_time_number'=>$data['book_time_number'],
                'book_total'=>$data['book_total'],
                'book_options'=> $data['options'],
            ];
            // dd($booking_details);

            $bookdetail = Booking_details::create($booking_details);

            $msg = 'Đặt lịch thành công';
            $style = 'success';

        }else{


            $msg = 'Có lỗi xảy ra khi đặt lịch! Vui lòng kiểm tra lại.';
            $style = 'danger';

        }

        return redirect()->back()->with(compact('msg','style'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
