<div class="table-responsive">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th>Địa chỉ</th>
                <th>Ngày làm việc</th>
                <th>Thời lượng</th>
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
                @endphp
                <tr>
                    <td>{{ $value->book_address }}</td>
                    <td>{{ date('l d/m/Y',strtotime($value->book_date)).' - '. $value->book_time_start }}</td>
                    <td>{{ $value->book_time_number .'giờ,'.$value->book_time_start .' - '.$time_end }}</td>
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
                            <td><span class="btn btn-success" style="color: white;width: 170px;">Hoàn thành</span></td>
                    @endswitch
                    <td><button type="submit" class="btn btn-default btn-details" id="{{ $value->book_id }}">Xem chi tiết</button></td>

                </tr>
                @endforeach
                {{-- @else
                    <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

            @endif --}}
            <div id="modal-details"></div>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
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



    });
</script>
