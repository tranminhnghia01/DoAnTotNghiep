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
<div class="page-wrapper">
    <div class="checkout shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <div class="block billing-details">
                   <h4 class="widget-title">Đặt lịch</h4>
                   <form action="{{ route('home.book.create') }}" method="GET" class="checkout-form">
                        {{-- @csrf --}}
                        <div class="col-md-12">
                            <h3 for="streetaddress">Địa chỉ</h3>
                            <div class="form-group">
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="book_address" placeholder="Số nhà và tên đường..." value="@if ($shipping)
                                    {{$shipping->shipping_address}}  @endif">
                                </div>
                                <div class="col-md-3">
                                    @if ($shipping)
                                        <a href="{{ route('home.checkout') }}"style="float: right; font-size: 15px;">Thay đổi<i class="fa-solid fa-chevron-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 for="streetaddress">Diện tích</h3>
                            <div class="btn-group row" data-toggle="buttons">

                                <div class="col-md-6">
                                    <label class="btn" style="background-color: #e3e3e3; margin-bottom: 5px;width: 85%;">
                                        <input type="radio" name="book_s" value="2" id="option1">
                                        <p >( < 50m <sup>2</sup> )</p>
                                        <p>Tối thiểu 2 giờ làm việc</p>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="btn" style="background-color: #e3e3e3; margin-bottom: 5px;width: 85%">
                                        <input type="radio" name="book_s" value="3" id="option2">  <p >(50 - 90m <sup>2</sup> )</p>
                                        <p>Tối thiểu 3 giờ làm việc</p>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="btn" style="background-color: #e3e3e3; margin-bottom: 5px;width: 85%">
                                        <input type="radio" name="book_s" value="4" id="option3">  <p >(90 - 140m <sup>2</sup> )</p>
                                        <p>Tối thiểu 4 giờ làm việc</p>
                                    </label>
                                </div>


                                <div class="col-md-6">
                                    <label class="btn" style="background-color: #e3e3e3; margin-bottom: 5px;width: 85%">
                                        <input type="radio" name="book_s" value="5" id="option3">  <p >(140 - 250m <sup>2</sup> )</p>
                                        <p>Tối thiểu 5 giờ làm việc</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h3 for="streetaddress">Ngày bắt đầu</h3>
                            <div class="form-group">
                                <input type="date" class="date form-control" name="book_date" placeholder="House number and street name">
                                @error('book_date')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                       <div class="col-md-12">
                           <label for="streetaddress">Giờ bắt đầu</label>
                           <div class="input-group form-group">
                               <input type="text" id="book-time-start" name="book_time_start" class="form-control timepicker-bs4 book-time-start" data-format="HH:mm" min="08:00" max="23:00" step="1800" />
                                 <div class="input-group-append">
                                   <button type="button" class="btn btn-outline-secondary" id="book-time-start-btn" data-toggle="timepicker"><i class="far fa-clock"></i></button>
                                 </div>
                           </div>
                       </div>

                       <div class="col-md-12">
                           <label for="streetaddress">Giờ kết thúc</label>
                           <div class="input-group form-group">
                               <input type="text" id="book-time-end" name="book_time_end" class="form-control timepicker-bs4 book-time-end" data-format="HH:mm" max="23:00" step="1800" />
                                 <div class="input-group-append">
                                   <button type="button" class="btn btn-outline-secondary" id="book-time-end-btn" data-toggle="timepicker"><i class="far fa-clock"></i></button>
                                 </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone">Notes</label>
                                <textarea name="book_notes" id="" cols="30" rows="10" class="form-control" style="height: 100px !important"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="betwend" id="betwend_time">
                        @if (Auth::check())
                            <button type="submit" class="btn btn-primary mt-20">Xác nhận thông tin</button>
                        @else
                            <a href="{{ route('home.login') }}" class="btn btn-primary mt-20">Vui lòng đăng nhập</a>
                        @endif
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
@endsection
