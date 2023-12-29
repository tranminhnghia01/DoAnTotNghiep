
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
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" >
                <div class="rounded p-5" style="background-color: #fff; padding-bottom: 3rem;">
                    <div class="table-responsive">
                        <table class="table datatable" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày bắt đầu làm việc</th>
                                    <th>Dịch vụ</th>
                                    <th>Tổng hóa đơn</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($book as $key=>$value )
                                    @php
                                        $time= explode(':',$value->book_time_start);
                                        $time_end = $time[0]+ $value->book_time_number.':'.$time[1];
                                        $weekday = [
                                            'Monday' => 'Thứ 2',
                                            'Tuesday' => 'Thứ 3',
                                            'Wednesday' => 'Thứ 4',
                                            'Thursday' => 'Thứ 5',
                                            'Friday' => 'Thứ 6',
                                            'Saturday' => 'Thứ 7',
                                            'Sunday' => 'Chủ nhật',
                                        ];
                                        $date =  explode(",",$value->book_date);
                                                $changedate = explode("/",$date[0]);
                                                $date[0] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];

                                        $checkcomment = 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start }}</td>
                                        <td>{{ $value->service_name }}</td>
                                        <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                                        @switch($value->book_status)
                                            @case(1)
                                                <td><span class="btn btn-warning" style="color: white;width: 170px;">Đang đợi xác nhận</span></td>
                                                @break
                                            @case(2)
                                                <td><span class="btn btn-success" style="color: white;width: 170px;">Đã xác nhận </span></td>
                                                @break
                                            @case(3)
                                                <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                                @break
                                            @default
                                                @foreach ($check_comment as $checkCM =>$valCM )
                                                    @if ($valCM->book_id == $value->book_id)
                                                        @php
                                                            $checkcomment = 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($checkcomment == 1)
                                                    <td><a  class="btn btn-primary" href="{{ route('home.home-housekeeper.show',$valCM->housekeeper_id) }}" style="color: white;width: 170px;">Xem đánh giá</a></td>
                                                @else
                                                    <td><span class="btn btn-primary danhgia" id="danhgia"  data-book_id="{{ $value->book_id}}" style="color: white;width: 170px;">Đánh giá</span><br></td>
                                                @endif
                                            @break
                                        @endswitch
                                       <td><a href="{{ route('home.Account.show.details',$value->book_id) }}" >Xem chi tiết</a></td>
                                        <td><button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}"><i class="fa fa-eye"></i></button></td>
                                    </tr>
                                @endforeach
                                <div id="modal-details"></div>
                                <div id="modal-danhgia"></div>
                            </tbody>
                        </table>
                    </div>
                </div>
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
        // var _token = $('input[name="_token"]').val();
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
    // Kết thúc ca lẻ>>>>>>>>>>>


    // //>>>>>>>> bắt đầu Ca cố định
    // $('.btn-details-fixed').on('click',function(){
    //     $('#modal-details').show();
    //     $("#address").val();

    //     var book_id = $(this).attr('id');
    //     // var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url : "",
    //         method: 'GET',
    //         data:{book_id:book_id},
    //         success:function(data){
    //             $('#modal-details').html(data);
    //             $('#exampleModal').modal('show');

    //         }
    //     });

    // });
    // $(document).on('click', '.btn-change-bookdefault', function(e){
    //     e.preventDefault(); //cancel default action
    //      var history_notes = $('textarea[name="history_notes"]').val();
    //     if (history_notes  == "") {
    //         swal({
    //                 title: "Lỗi!",
    //                 text: "Vui lòng nếu lý do trước để tiếp tục hủy!",
    //                 icon: "warning",
    //                 dangerMode: true,
    //                 });
    //     }else{
    //         swal({
    //         title: "Hủy ??",
    //         text: 'Bạn có chắc muốn hủy đơn đặt lịch này!',
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //             var book_id = $(this).data('book-id');
    //             var _token = $('input[name="_token"]').val();
    //             $.ajax({
    //                 url : "",
    //                 method: 'POST',
    //                 data:{book_id:book_id,_token:_token,history_notes:history_notes},
    //                 success:function(data){
    //                     console.log(data);
    //                     swal("Thành công! Đơn đặt lịch của bạn đã được hủy!", {
    //                         icon: "success",
    //                         });
    //                         window.setTimeout(function() {
    //                             location.reload();
    //                         },3000);
    //                     }
    //                 });
    //         } else {
    //             swal("Thoát thao tác thành công!");
    //         }
    //     });
    //     };


    // });
    // // Kết thúc ca cố định<<<<<<<<<<



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




});
</script>
@endsection
