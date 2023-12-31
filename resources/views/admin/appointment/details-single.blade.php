@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
        <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" >
            <div class="rounded " style="background-color: #fff; ">
                <div class="table-responsive">
                    <div class="modal-dialog">
                        <div class="bg-white modal-content">
                            <div class="modal-header">
                                <h5 class="card-title">Chi tiết công việc</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color: #000;">

                                <div class="row g-3">
                                    <h5 class="modal-title">Người giúp việc</h5>
                                    <div class="col-sm-3" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                        <img src="{{ asset('uploads/users/'.$history->image) }}" alt="Girl in a jacket" width="150px" height="150px">
                                    </div>
                                    <div class="col-sm-9" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                    <p style="font-weight: 600"> {{ $history->name }} </p>
                                    <p> Số điện thoại: (+84)  {{ $history->phone }} </p>
                                </div>
                                    <h5 class="modal-title">Vị trí làm việc</h5>
                                    <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                                        <p style="font-weight: 600"> {{ $shipping->shipping_name }} </p>
                                        <p> Số điện thoại: (+84)  {{  $shipping->shipping_phone}} </p>
                                        <p> {{ $shipping->shipping_address }} </p>
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
                                                @foreach ($listdate as $key => $value)
                                                    <option>{{ $listdate[$key] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="display: flex; justify-content: space-between">
                                            <label for="">Làm trong</label>
                                            <p class="check-time">{{ $history->book_time_number }} giờ, {{ $history->book_time_start }} đến  {{ $time_end }}</p>
                                        </div>
                                        <div style="display: flex; justify-content: space-between">
                                        <label for="">Tổng số buổi</label>
                                        <p class="check-date">{{ count($listdate) }}</p>
                                    </div>
                                    @if($history->service_id == 2)
                                        <div style="display: flex; justify-content: space-between">
                                            <label for="">Số buổi đã hoàn thành</label>
                                            <p class="check-date">{{ $history->date_finish + $history->history_previous_date }}</p>
                                        </div>
                                    @endif
                                        <div style="display: flex; justify-content: space-between">
                                            <label for="">Dịch vụ thêm</label>
                                            <p id="options" class="check-options">{{ $history->book_options }}</p>
                                        </div>

                                        <div style="display: flex; justify-content: space-between">
                                            <label for="">Ghi chú cho người làm</label>
                                            <p class="check-notes"> {{ $history->book_notes }} </p>
                                        </div>
                                    </div>
                                    <div style="display: flex; justify-content: space-between">
                                    <div class="col-sm-6">
                                        <h5 class="modal-title">Khuyễn mãi</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                                            <option selected>{{ $coupon_number}} {{ $method }} </option>
                                        </select>
                                    </div>
                                </div>

                                    <div style="display: flex; justify-content: space-between">
                                        <div class="col-sm-4">
                                            <h5 class="modal-title">Phương thức thanh toán</h5>
                                        </div>
                                            <div class="row">
                                            <div class="col-sm-6">
                                                <select class="form-select border-0" style="height: 55px;" name="payment_id">
                                                    <option value=" {{ $history->payment_id }} ">{{ $history->payment_method }}</option>
                                                </select>
                                            </div>
                                                @if($paymentonline)
                                                    <div class="col-sm-6">
                                                        <a class="btn btn-primary py-3" disable style="width:100%;color: #fff" >Đã thanh toán</a>
                                                    </div>

                                                @else
                                                    <div class="col-sm-6">
                                                        <a class="btn btn-primary py-3" disable style="width:100%;color: #fff" >Chưa thanh toán</a>
                                                    </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                                <h4 class="modal-title">Tổng Cộng</h4>
                            <h4 class="modal-title book-total"> {{ number_format($history->book_total) }} <sup>đ</sup>  </h4>
                            </div>

                            <div class="modal-footer">
                                @if ($user->user_id == '00000')
                                @else
                                <form>
                                    @csrf
                                    @switch ($history->book_status)
                                        @case(4)
                                        <button type="button"  class="btn btn-default py-3"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Đóng</i></button>
                                            @break
                                            @case(2)
                                                    <div style="display: flex; justify-content: space-between">
                                                        <label for="" style="width:50%">
                                                            <span style="font-weight:800;color:black">Lý do hủy: </span><br>
                                                            <span style="color:red;font-size: 14px;">Nêu lý do không tiếp tục công việc(bắt buộc).</span>
                                                        </label>
                                                        <textarea class="destroy-text" id="history_notes" name="history_notes" rows="4" cols="50"></textarea>
                                                    </div>
                                                    <div style="display: flex;justify-content: space-between;padding-left: 16%;padding-top: 12px; ">
                                                    <button type="button" class="btn btn-danger py-3 btn-bookdestroy" data-book-id="{{$history->history_id}}"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                                </div>
                                            @break

                                            @case(3)
                                            <button type="button"  class="btn btn-primary py-3  "><i class="tf-ion-close" aria-hidden="true">Đăng lại</i></button>
                                        @break
                                        @default
                                                <button type="button" class="btn btn-danger  py-3 btn-bookdestroy" data-book-id="{{ $history->history_id }}"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                        @break
                                        @endswitch
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
