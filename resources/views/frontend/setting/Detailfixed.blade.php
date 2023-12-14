
@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div>
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
                        <p style="font-weight: 600">'.$shipping->shipping_name.'</p>
                        <p> Số điện thoại: (+84)  '.$shipping->shipping_phone.'</p>
                        <p> '.$shipping->shipping_address.'</p>
                            <p><a href="'.route('home.checkout').'" class="btn btn-success" style="float: right">Thay đổi</a></p>
                        </div>
                        <h5 class="modal-title">Thông tin công việc</h5>
                        <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                            <p style="font-weight: 600">Thời gian làm việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ngày bắt đầu làm việc</label>
                                <p class="check-date">'.$weekday[date('l',strtotime($data['book_date'][0]))].', '.date('d/m/Y',strtotime($data['book_date'][0])).'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ngày kết thúc làm việc</label>
                                <p class="check-date">'.$weekday[date('l',strtotime($data['book_date'][$count_date-1]))].', '.date('d/m/Y',strtotime($data['book_date'][$count_date-1])).'</p>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <label for="">Làm trong</label>
                                <p class="check-time">'.$book_time_number.' giờ, '.$book_time_start.' đến '.$time_end.'</p>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <label for="">Số buổi</label>
                                <p class="check-date">'.$count_date.'</p>
                            </div>

                            <p style="font-weight: 600">Chi tiết công việc</p>
                            <div style="display: flex; justify-content: space-between">
                                <label for="">Khối lượng công việc</label>
                                <p class="check-g">'.$klcv.'</p>
                            </div>


                            <div style="display: flex; justify-content: space-between">
                                <label for="">Ghi chú cho người làm</label>
                                <p class="check-notes">'.$book_notes.'</p>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Phương thức thanh toán</h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="modal-title">Khuyễn mãi</h5>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: space-between">
                                <div class="col-sm-6">
                                <select class="form-select border-0" style="height: 55px;" name="payment_id">';
                                foreach ($payment as $key => $valP) {
                                    $output .=' <option value="'.$valP->payment_id.'">'.$valP->payment_method.'</option>';
                                }
                                 $output .='
                                </select>
                                </div>
                                <div class="col-sm-6">
                                <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                            <option selected  value="0,0,0">Khuyễn mãi</option>';
                            foreach ($coupon as $key => $valC) {
                                $time_end = date('d/m/Y',strtotime($valC->coupon_time_end));
                                $today = date('d/m/Y',strtotime(now()));
                                $output .=' <option value="'. $valC->coupon_id .','. $valC->coupon_method .','. $valC->coupon_number .'" ';
                                if ( ($time_end <= $today)) {
                                    $output.='disabled style="color: red"';
                                }
                                $output.='>'. $valC->coupon_name.'</option>';
                            }
                             $output .='

                        </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between">
                            <h4 class="modal-title">Tổng Cộng</h4>
                            <h4 class="modal-title book-total">'.number_format($total).'đ</h4>
                            <input type="hidden" name="book_total" value="'.$total.'">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-orange w-100 py-3">Đặt lịch</button>
                        </div>
                    </div>
                </div>
            </div>'
        </div>
    </div>
</div>

  @endsection
