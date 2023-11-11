@extends('frontend.layouts.blocks.app')

@section('content')
@include('frontend.layouts.blocks.page-header')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="{{ asset('easy-time-picker-bootstrap/docs/js/timepicker-bs4.js?') }}" defer="defer"></script>
</head>
@if (session('msg'))
<div class="alert alert-{{session('style')}}">
    {{ session('msg') }}
</div>
@endif
@php
    $coupon_code = "";
    $total_coupon = 0;
@endphp
@if(Session::get('coupon'))
    @php
        $coupon = Session::get('coupon');
    @endphp
    @foreach ($coupon as $key=>$cou )
        @php
            $coupon_code = $cou['coupon_code'];
        @endphp
        @if($cou['coupon_method'] == 1)
            @php
                $total_coupon= $cou['coupon_number'];
            @endphp
        @elseif($cou['coupon_method']==0)
            @php
                $total_coupon=  $data['total'] *$cou['coupon_number']/100 ;
            @endphp
        @endif
    @endforeach
@else
    @php
        $total_coupon = 0;
    @endphp
@endif

    <div class="checkout shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <div class="block billing-details">
                   <h4 class="widget-title">Thông tin công việc</h4>
                   <form action="{{ route('home.book.store') }}" method="POST" class="checkout-form">
                        @csrf
                        <div class="product-checkout-details">
                            <div class="block">
                               <div class="summary-prices"style="padding: 0px" >
                                <ul style="margin: 0px">
                                    <li><span style="color: #888; font-size: 14px">Địa chỉ</span></li>
                                    <li><input style=" font-size: 14px; margin-left: 10px; border: none;width: 100%;outline: none" readonly  value="{{ $data['book_address'] }}" name="book_address"></li>
                                </ul>
                               </div>
                               <div class="summary-prices"style="padding: 0px" >
                                <ul style="margin: 0px">
                                        <li><span style="color: #888; font-size: 14px">Ngày đặt lịch</span></li>
                                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none" readonly  value="{{date('l d-m-Y', strtotime($data['book_date']))}}" name="book_date"></li>
                                    </ul>
                               </div>
                               <div class="summary-prices"style="padding: 0px" >
                                <ul style="margin: 0px">
                                        <li><span style="color: #888; font-size: 14px">Thời gian bắt đầu - kết thúc ca</span></li>
                                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none" readonly  value="{{ $data['book_time_start'] .'-'.$data['book_time_end'] }}" name="book_time"></li>
                                    </ul>
                                </div>
                                <div class="summary-prices"style="padding: 0px" >
                                <ul style="margin: 0px">
                                        <li><span style="color: #888; font-size: 14px">Ghi chú</span></li>
                                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none; width: 100%;" readonly value="{{ $data['book_notes'] }}" name="book_notes"></li>
                                    </ul>
                                </div>
                                <div class="summary-prices"style="padding: 0px" >
                                    <ul style="margin: 0px">
                                        <li><span style="color: #888; font-size: 14px">Phí dịch vụ</span></li>
                                        <ul>
                                            <li>
                                                <span>Phí dịch vụ ({{$data['betwend']}}h)</span>
                                                <span>{{ number_format($data['total'])}} <sup>đ</sup> </span>
                                            </li>
                                            <li>
                                                <span>Giá dịch vụ gốc ( {{$data['betwend'] .'x'. $data['price_df'].'đ'}} )</span>
                                                <span>{{ number_format($data['betwend'] * $data['price_df'])}} <sup>đ</sup> </span>
                                            </li>
                                            <li>
                                                <span>Làm việc sau 17h ({{$data['time_after_df'] .'x 10.000đ'}})</span>
                                                <span>{{  number_format($data['time_after_df'] * 10000) }} <sup>đ</sup> </span>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="summary-prices"style="padding: 0px" >
                                    <ul style="margin: 0px">
                                        <li><span style="color: #888; font-size: 14px">Phương thức thanh toán</span></li>
                                        <li><h2 style=" font-size: 14px; margin-left: 10px">
                                                @foreach ($payment as $valpay)
                                                    <label style="margin-right: 20px"><input type="radio" name="payment_id" value="{{$valpay->payment_id}}" class="mr-2"> {{ $valpay->payment_method }}</label>
                                            @endforeach
                                        </h2></li>
                                        @error('payment_id')
                                        <li style="color: red">{{ $message }}</li>
                                        @enderror
                                    </ul>
                                </div>
                                <div class="summary-prices"style="padding: 0px" >
                                    <ul style="margin: 0px">
                                        <ul>
                                            <li><span style="color: #888; font-size: 14px">Mã giảm giá <a data-toggle="modal" data-target="#coupon-modal" href="#!">Ưu đãi</a></span></li>
                                            <li><h2 style=" font-size: 14px; margin-left: 10px">
                                                <ul>
                                                    @if(Session::get('coupon'))
                                                    <li>
                                                        <span>Áp dụng mã giảm giá</span>
                                                        <span>{{  number_format($total_coupon) }} <sup>đ</sup> </span>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </h2></li>
                                        </ul>
                                    </div>

                               <div class="summary-total" style="background: #ff7800;
                                 padding: 6px;
                                 color: white;">
                                  <span>Tổng cộng</span>
                                  <span>
                                    {{ number_format($data['total'] - $total_coupon)}} <sup>đ</sup>
                                  </span>
                               </div>

                               <div class="verified-icon">
                                  <img src="images/shop/verified.png">
                               </div>
                            </div>
                         </div>

                         <input type="hidden" name="coupon" value="{{$coupon_code}}" >
                         <input type="hidden" name="book_total" value="{{ number_format($data['total'] - $total_coupon)}}">
                         <input type="hidden" name="book_time_total" value="{{ $data['betwend']}}">

                         <a class="btn btn-primary mt-20">
                                <button type="submit" class="btn btn-primary" style="padding: 5px"><h3>Thanh toán</h3></button>
                         </a>
                    </form>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                                <a class="nav-item nav-link active" data-toggle="tab" style="font-size: 14px" href="#tab-pane-1">Dọn nhà bếp</a>
                                <a class="nav-item nav-link" data-toggle="tab" style="font-size: 14px" href="#tab-pane-2">Dọn phòng tắm</a>
                                <a class="nav-item nav-link" data-toggle="tab" style="font-size: 14px" href="#tab-pane-3">Phòng ngủ</a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active in" id="tab-pane-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media mb-4">
                                                <img src="{{ asset('uploads/images/deep-cleaning-nha-bep.png') }}" alt="Image" class="img-fluid mr-3 mt-1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="mb-4">Nhà bếp</h4>
                                            <p>◆ Rửa chén và xếp chén đĩa</p>
                                            <p>◆ Lau bụi và lau tất cả các bề mặt có thể tiếp cận</p>
                                            <p>◆ Lau mặt ngoài của tủ bếp, các thiết bị gia dụng</p>
                                            <p>◆ Lau các công tắc và tay cầm</p>
                                            <p>◆ Cọ rửa bếp</p>
                                            <p>◆ Lau mặt bàn</p>
                                            <p>◆ Làm sạch bồn rửa</p>
                                            <p>◆ Đổ rác</p>
                                            <p>◆ Quét và lau sàn nhà</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-pane-2">
                                    <h4 class="mb-3">Dọn phòng tắm</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media mb-4">
                                                <img src="{{ asset('uploads/images/deep-cleaning-nha-tam.png') }}" alt="Image" class="img-fluid mr-3 mt-1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="mb-4">Phòng tắm</h4>
                                            <p>◆ Rửa chén và xếp chén đĩa</p>
                                            <p>◆ Lau bụi và lau tất cả các bề mặt có thể tiếp cận</p>
                                            <p>◆ Lau mặt ngoài của tủ bếp, các thiết bị gia dụng</p>
                                            <p>◆ Lau các công tắc và tay cầm</p>
                                            <p>◆ Cọ rửa bếp</p>
                                            <p>◆ Lau mặt bàn</p>
                                            <p>◆ Làm sạch bồn rửa</p>
                                            <p>◆ Đổ rác</p>
                                            <p>◆ Quét và lau sàn nhà</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-pane-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media mb-4">
                                                <img src="{{ asset('uploads/images/deep-cleaning-phong-ngu.png') }}" alt="Image" class="img-fluid mr-3 mt-1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="mb-4">Phòng ngủ</h4>
                                            <p>◆ Rửa chén và xếp chén đĩa</p>
                                            <p>◆ Lau bụi và lau tất cả các bề mặt có thể tiếp cận</p>
                                            <p>◆ Lau mặt ngoài của tủ bếp, các thiết bị gia dụng</p>
                                            <p>◆ Lau các công tắc và tay cầm</p>
                                            <p>◆ Cọ rửa bếp</p>
                                            <p>◆ Lau mặt bàn</p>
                                            <p>◆ Làm sạch bồn rửa</p>
                                            <p>◆ Đổ rác</p>
                                            <p>◆ Quét và lau sàn nhà</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-body">
                 <form>
                    @csrf
                    <div class="form-group">
                       <input class="form-control" type="text" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code">
                    </div>
                    <a class="btn btn-main Apply-Coupon">Apply Coupon</a>
                 </form>
              </div>
           </div>
        </div>
     </div>
<script>
    $(document).ready(function(){
        jQuery('input.timepicker-bs4').timepicker();
        $('#book-time-start').on('change',function(){
            var start =  $(this).val();
            // alert(start);
            var time_word_df = Number($("input[type='radio'][name='book_s']:checked").val());
            if (isNaN(time_word_df)) {
                $(this).val('08:00');
                alert('Vui lòng chọn diện tích căn hộ');
            }
            else{
                var hour=0;
                var minute=0;
                var splitTime1= start.split(':');
                hour = parseInt(splitTime1[0])+time_word_df;
                minute = parseInt(splitTime1[1]);
                var min_end = hour+':'+minute;
                console.log(time_word_df);
                console.log(min_end);
                console.log(splitTime1);
                document.getElementById("book-time-end").min = min_end;
                jQuery('input.timepicker-bs4').timepicker();
                jQuery('input #book-time-end').timepicker();

            }
        });

        $('#book-time-end').on('change',function(){

        var start_time = $('.book-time-start').val();
        var end_time = $(this).val();
        var time_word_df = Number($("input[type='radio'][name='book_s']:checked").val());

        var split_start_time= start_time.split(':');
        var split_end_time= end_time.split(':');

        var hour_start = parseInt(split_start_time[0])+parseInt(split_start_time[1])/60;
        var hour_end = parseInt(split_end_time[0])+parseInt(split_end_time[1])/60;

        var betwend = hour_end - hour_start;
        $('#betwend_time').val(betwend);
        console.log(betwend);

        if (betwend > 0) {
            if (betwend > 6) {
                console.log('Thời gian làm việc tối đa là 6h');
            }if (betwend >= time_word_df && betwend <= 6) {
                    console.log('Thời gian hợp lệ');

            } if(betwend < time_word_df) {
                console.log('Thời gian làm việc tối thiểu là',time_word_df,'h');
            }
        }else{
            console.log('Thời gian không hợp lệ');
        };

    });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
        $('.Apply-Coupon').on('click',function(){
        var coupon_code = $('#coupon_code').val();
        // alert(_token);
        $.ajax({
            url : "{{route('home.coupon-book')}}",
            method: 'get',
            data:{coupon_code:coupon_code,_token:_token},
            success:function(data){
                console.log(data);
                window.setTimeout(function() {
                    location.reload();
                },3000);
            }
        });
    });
  });

</script>
@endsection
