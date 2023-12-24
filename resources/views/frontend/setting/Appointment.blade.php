<div class="table-responsive">
    <table class="table datatable" style="text-align: center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Địa chỉ</th>
                <th>Ngày bắt đầu làm việc</th>
                <th>Số buổi</th>
                <th>Dịch vụ</th>
                <th>Tổng hóa đơn</th>
                <th>Tình trạng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- @if (!empty($book)) --}}
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
                @endphp
                <tr>
                    <td>{{ $key+1}}</td>
                    <td>{{ $value->book_address }}</td>

                        <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start }}</td>
                        <td>{{ Count($date) }}</td>

                    <td>{{ $value->service_name }}</td>
                    <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                    @switch($value->book_status)
                        @case(1)
                            <td><span class="btn btn-warning" style="color: white;width: 170px;">Đang đợi xác nhận</span></td>
                            @break
                        @case(2)
                            <td><span class="btn btn-primary" style="color: white;width: 170px;">Đã xác nhận </span></td>
                            @break
                        @case(3)
                            <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                            @break
                        @default
                            <td><span class="btn btn-success" style="color: white;width: 170px;">Hoàn thành</span><br>
                                @foreach ($check_comment as $checkCM =>$valCM )
                                    @if ($valCM->book_id == $value->book_id)
                                        <a id="xemdanhgia" class="xemdanhgia" data-book_id="{{ $value->book_id }}">Xem đánh giá</a></td>

                                    @else
                                        <a id="danhgia" class="danhgia" data-book_id="{{ $value->book_id }}">Đánh giá</a></td>
                                    @endif
                                @endforeach
                    @endswitch
                    @if ($value->service_id == 1)
                         <td><button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}">Xem chi tiết</button></td>
                    @else
                        {{-- <td><a href="{{ route('home.appointment.details',$value->book_id) }}" class="btn btn-default btn-details-fixed" id="{{ $value->book_id }}">Xem chi tiết</a></td> --}}
                        <td><button type="submit" class="btn btn-default btn-details-fixed" id="{{ $value->book_id }}">Xem chi tiết</button></td>

                    @endif

                </tr>
                @endforeach
                {{-- @else
                    <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

            @endif --}}
            <div id="modal-details"></div>
            <div id="modal-danhgia"></div>
        </tbody>
    </table>
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
                    data:{book_id:book_id,_token:_token},
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

    });
    // Kết thúc ca lẻ>>>>>>>>>>>


    //>>>>>>>> bắt đầu Ca cố định
    $('.btn-details-fixed').on('click',function(){
        $('#modal-details').show();
        $("#address").val();

        var book_id = $(this).attr('id');
        // var _token = $('input[name="_token"]').val();
        $.ajax({
            url : "{{route('home.appointment.showfixed')}}",
            method: 'GET',
            data:{book_id:book_id},
            success:function(data){
                $('#modal-details').html(data);
                $('#exampleModal').modal('show');

            }
        });

    });
    $(document).on('click', '.btn-change-bookdefault', function(e){
        e.preventDefault(); //cancel default action
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
                    url : "{{route('home.appointment.destroydefault')}}",
                    method: 'POST',
                    data:{book_id:book_id,_token:_token},
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

    });
    // Kết thúc ca cố định<<<<<<<<<<



    //Dánh giá modal
    $('#danhgia').on('click',function(){
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
