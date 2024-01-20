
@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Cài đặt</p>
            <h1>Hồ sơ cá nhân</h1>
        </div>
        <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body pt-3">
                  <!-- Bordered Tabs -->
                  <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Đơn lịch đang đặt</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Đơn lịch đã đặt</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" role="tab" tabindex="-1">Đơn lịch đã hủy</button>
                    </li>
                  </ul>
                  <div class="tab-content pt-2">

                    <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                        <h5 class="card-title">Đơn lịch đang đặt</h5>
                         @foreach ($book as $key=>$value)
                            @php
                                $time= explode(':',$value->book_time_start);
                                $time_end = $time[0]+ $value->book_time_number.':'.$time[1];
                                $date =  explode(",",$value->book_date);
                                        $changedate = explode("/",$date[0]);
                                        $date[0] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                $checkcomment = 0;
                            @endphp
                            @if ($value->book_status == 1 || $value->book_status ==2)
                                <div style="display: flex; justify-content: space-between; padding: 10px; align-items: center; min-height: 100px; border: 1px solid #ccc; border-radius: 5px;color: #000; font-weight: 500;margin-bottom: 12px;letter-spacing: -1px;">
                                    <div style="min-width: 250px;max-width: 260px;">
                                        <p style="margin: 0">Địa chỉ<br> <span style="color: #2c2a2a;font-size: 12px">{{ $value->book_address }}</span></p>
                                    </div>
                                    <div style="min-width: 100px"><p style="margin: 0">{{ number_format($value->book_total) }} <sup>đ</sup> </p></div>
                                    <div>
                                        <p style="margin: 0">Thời gian bắt đầu<br> <span style="color: red">{{$value->book_time_start.' - '.date('d/m/Y',strtotime($date[0]))}}</span></p>
                                    </div>
                                    <div style="min-width: 250px;max-width:260px ;">
                                        <p class="role-4" style="margin: 0;font-weight:550">Ghi chú: <span style="color: #2c2a2a;font-weight:300">{{ $value->book_notes }}</span></p>
                                    </div>
                                        @if ($value->book_status == 1)
                                            <span class="btn btn-warning" style="color: white;width: 170px;">Đang đợi xác nhận</span>
                                        @else
                                            <span class="btn btn-success" style="color: white;width: 170px;">Đã xác nhận </span>
                                        @endif
                                    <div>
                                        <a href="{{ route('home.Account.show.details',$value->book_id) }}" >Xem chi tiết</a>
                                        <button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                        <h5 class="card-title">Đơn lịch đã đặt</h5>
                        @foreach ($book as $key=>$value )
                            @php
                                $time= explode(':',$value->book_time_start);
                                $time_end = $time[0]+ $value->book_time_number.':'.$time[1];
                                $date =  explode(",",$value->book_date);
                                        $changedate = explode("/",$date[0]);
                                        $date[0] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                $checkcomment = 0;
                            @endphp
                            @if ($value->book_status == 4)
                                <div style="display: flex; justify-content: space-between; padding: 10px; align-items: center; min-height: 100px; border: 1px solid #ccc; border-radius: 5px;color: #000; font-weight: 500;margin-bottom: 12px;letter-spacing: -1px;">
                                    <div style="min-width: 250px">
                                        <p style="margin: 0">Địa chỉ<br> <span style="color: #2c2a2a;font-size: 12px">{{ $value->book_address }}</span></p>
                                    </div>
                                    <div style="min-width: 100px"><p style="margin: 0">{{ number_format($value->book_total) }} <sup>đ</sup> </p></div>
                                    <div>
                                        <p style="margin: 0">Thời gian bắt đầu<br> <span style="color: red">{{$value->book_time_start.' - '.date('d/m/Y',strtotime($date[0]))}}</span></p>
                                    </div>
                                    <div style="min-width: 250px;max-width:260px ;">
                                        <p class="role-4" style="margin: 0;font-weight:550">Ghi chú: <span style="color: #2c2a2a;font-weight:300">{{ $value->book_notes }}</span></p>
                                    </div>
                                    @if ($value->book_status == 4)
                                        @foreach ($check_comment as $checkCM =>$valCM )
                                            @if ($valCM->book_id == $value->book_id)
                                                @php
                                                    $checkcomment = 1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($checkcomment == 1)
                                            <a  class="btn btn-primary show-danhgia" id="show-danhgia" data-book_id="{{ $value->book_id}}" style="color: white;width: 170px;">Xem đánh giá</a>
                                        @else
                                            <span class="btn btn-primary danhgia" id="danhgia"  data-book_id="{{ $value->book_id}}" style="color: white;width: 170px;">Đánh giá</span>
                                        @endif
                                    @endif

                                    <div>
                                        <a href="{{ route('home.Account.show.details',$value->book_id) }}" >Xem chi tiết</a>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            @endif

                         @endforeach
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">
                        <h5 class="card-title">Đơn lịch đã hủy</h5>
                        @foreach ($book as $key=>$value )
                            @php
                                $time= explode(':',$value->book_time_start);
                                $time_end = $time[0]+ $value->book_time_number.':'.$time[1];
                                $date =  explode(",",$value->book_date);
                                        $changedate = explode("/",$date[0]);
                                        $date[0] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                $checkcomment = 0;
                            @endphp
                            @if ($value->book_status == 3)
                                <div style="display: flex; justify-content: space-between; padding: 10px; align-items: center; min-height: 100px; border: 1px solid #ccc; border-radius: 5px;color: #000; font-weight: 500;margin-bottom: 12px;letter-spacing: -1px;">
                                    <div style="min-width: 250px">
                                        <p style="margin: 0">Địa chỉ<br> <span style="color: #2c2a2a;font-size: 12px">{{ $value->book_address }}</span></p>
                                    </div>
                                    <div style="min-width: 100px"><p style="margin: 0">{{ number_format($value->book_total) }} <sup>đ</sup> </p></div>
                                    <div>
                                        <p style="margin: 0">Thời gian bắt đầu<br> <span style="color: red">{{$value->book_time_start.' - '.date('d/m/Y',strtotime($date[0]))}}</span></p>
                                    </div>
                                    <div style="min-width: 250px;max-width:260px ;">
                                        <p class="role-4" style="margin: 0;font-weight:550">Ghi chú: <span style="color: #2c2a2a;font-weight:300">{{ $value->book_notes }}</span></p>
                                    </div>
                                    <span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span>

                                    <div>
                                        <a href="{{ route('home.Account.show.details',$value->book_id) }}" >Xem chi tiết</a>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                  </div><!-- End Bordered Tabs -->

                </div>
              </div>
              <div id="modal-details"></div>
              <div id="modal-danhgia"></div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){

        //>>>>>>>> bắt đầu Ca lẻ
            $('.btn-details').on('click',function(){
                $('#modal-details').show();
                $("#address").val();

                var book_id = $(this).attr('id');
                $.ajax({
                    url : "{{route('home.appointment.show')}}",
                    method: 'GET',
                    data:{book_id:book_id},
                    success:function(data){
                        $('#modal-details').html(data);
                        $('#exampleModal').modal('show');

                    }
                });

            });

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

            //Dánh giá modal
            $('.danhgia').on('click',function(){
                // $('#modal-details').show();
                // alert('234');
                var book_id = $(this).data('book_id');
                // alert(book_id);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : "{{route('home.appointment.danhgia')}}",
                    method: 'GET',
                    data:{book_id:book_id},
                    success:function(data){
                        $('#modal-danhgia').html(data);
                        $('#Modaldanhgia').modal('show');
                    }
                });
            });

            $('.show-danhgia').on('click',function(){
                // $('#modal-details').show();
                // alert('234');
                var book_id = $(this).data('book_id');
                // alert(book_id);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : "{{route('home.appointment.danhgia-show')}}",
                    method: 'GET',
                    data:{book_id:book_id},
                    success:function(data){
                        $('#modal-danhgia').html(data);
                        $('#Modaldanhgia').modal('show');
                    }
                });
            });
        });
    </script>
  @endsection
