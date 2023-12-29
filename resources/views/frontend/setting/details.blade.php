
@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Cài đặt</p>
            <h1>Quản lý đơn lịch</h1>
        </div>
        <div class="row g-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link " href="{{ route('home.appointment.index') }}" >Thông tin cá nhân</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link active " href="{{ route('home.Account.show') }}">Lịch sử đơn lịch</a>
                </li>
              </ul>
            {{-- <div class="col-lg-3 wow fadeIn" data-wow-delay="0.5s" >
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn lịch</th>
                            <th>Tổng hóa đơn</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listbook as $key=>$val )
                        <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $val->book_total }}</td>
                        <td>{{ $val->book_status }}</td>
                        <td><a  href="{{ route('home.Account.show.details',$val->book_id) }}">Xem</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}

            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" >
                <div class="rounded " style="background-color: #fff; ">
                    <div class="table-responsive">
                        <div class="modal-dialog">
                            <div class="bg-white modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hóa đơn</h5>
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
                                                <p class="check-time">{{ $book->book_time_number }} giờ, {{ $book->book_time_start }} đến  {{ $time_end }}</p>
                                            </div>
                                            <div style="display: flex; justify-content: space-between">
                                            <label for="">Tổng số buổi</label>
                                            <p class="check-date">{{ count($listdate) }}</p>
                                        </div>
                                        @if($book->service_id == 2)
                                            <div style="display: flex; justify-content: space-between">
                                                <label for="">Số buổi đã hoàn thành</label>
                                                <p class="check-date">{{ $history->date_finish + $history->history_previous_date }}</p>
                                            </div>
                                        @endif
                                            <div style="display: flex; justify-content: space-between">
                                                <label for="">Dịch vụ thêm</label>
                                                <p id="options" class="check-options">{{ $book->book_options }}</p>
                                            </div>

                                            <div style="display: flex; justify-content: space-between">
                                                <label for="">Ghi chú cho người làm</label>
                                                <p class="check-notes"> {{ $book->book_notes }} </p>
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
                                            <form action="{{ route('home.appointment.payment.online',$book->book_id ) }}" method="post"  class="col-sm-8">
                                                @csrf
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="form-select border-0" style="height: 55px;" name="payment_id">
                                                        @if($book->payment_id != 1)
                                                            <option selected value=" {{ $book->payment_id }} ">{{ $book->payment_method }}</option>
                                                        @else
                                                            @foreach ($payment as $key => $value)
                                                                <option value=" {{ $value->payment_id }} ">{{ $value->payment_method }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                @if ($book->book_status == 2)
                                                    @if($paymentonline)
                                                        <div class="col-sm-6">
                                                            <a class="btn btn-primary py-3" disable style="width:100%;color: #fff" >Đã thanh toán</a>
                                                        </div>

                                                    @else
                                                        <div class="col-sm-6">
                                                            <button type="submit" name="redirect"  class="btn btn-primary py-3" style="width:100%;color: #fff" >Thanh toán Online</button>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($book->book_status == 3 || $paymentonline)
                                                        <div class="col-sm-6">
                                                            <a class="btn btn-info py-3" disable style="width:100%;color: #fff" >Đã thanh toán online</a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                    <h4 class="modal-title">Tổng Cộng</h4>
                                <h4 class="modal-title book-total"> {{ number_format($book->book_total) }} <sup>đ</sup>  </h4>
                                </div>

                                <div class="modal-footer">
                                <form>
                                @csrf
                                @switch ($book->book_status)
                                    @case(4)
                                    <button type="button"  class="btn btn-default py-3"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Đóng</i></button>
                                        @break
                                        @case(2)
                                                <div style="display: flex; justify-content: space-between">
                                                    <label for="" style="width:50%">
                                                        <span style="font-weight:800;color:black">Lý do hủy: </span><br>
                                                        <span style="color:red;font-size: 14px;">Quy định hủy lịch khi đã thanh toán ca cố định:<br>Hoàn tiền những buổi chưa làm việc và trừ 20% tổng giá trị ban đầu.</span>
                                                    </label>
                                                    <textarea class="destroy-text" id="history_notes" name="history_notes" rows="4" cols="50"></textarea>
                                                </div>
                                                <div style="display: flex;justify-content: space-between;padding-left: 16%;padding-top: 12px; ">
                                                <button type="button" class="btn btn-danger  py-3 btn-change-book" data-book-id="{{$book->book_id}}"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                            </div>
                                        @break

                                        @case(3)
                                        <button type="button"  class="btn btn-primary py-3  "><i class="tf-ion-close" aria-hidden="true">Đăng lại</i></button>
                                    @break

                                    @default
                                            <button type="button" class="btn btn-danger  py-3 btn-change-book" data-book-id="{{ $book->book_id }}"  style="width:150px"><i class="tf-ion-close" aria-hidden="true">Hủy lịch</i></button>
                                    @break
                                    @endswitch
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on('click', '.btn-change-book', function(e){
        e.preventDefault(); //cancel default action
        var history_notes = $('textarea[name="history_notes"]').val();
        if (history_notes == "") {
            swal({
                    title: "Lỗi!",
                    text: "Vui lòng nếu lý do trước để tiếp tục hủy!",
                    icon: "warning",
                    dangerMode: true,
                    });
        }else{
            swal({
            title: "Hủy ??",
            text: 'Bạn có chắc muốn hủy đơn đặt lịch này!',
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var book_id = $(this).data('book-id');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url : "{{route('home.appointment.destroy')}}",
                        method: 'POST',
                        data:{history_notes:history_notes,book_id:book_id,_token:_token},
                        success:function(data){
                            swal("Thành công! Đơn đặt lịch của bạn đã được hủy!", {
                                icon: "success",
                                });
                                window.setTimeout(function() {
                                    location.reload();
                                },3000);
                            }
                        });
                } else {
                    swal("Thoát thao tác thành công!");
                }
            });
        };



    });
    })
</script>

@endsection
