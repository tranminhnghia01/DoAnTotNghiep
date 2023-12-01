<div class="table-responsive">
    <table class="table">
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
                            <td><span class="btn btn-warning">Đang đợi xác nhận</span></td>
                            @break
                        @case(2)
                            <td><span class="btn btn-primary">Đã xác nhận </span></td>
                            @break
                        @case(3)
                            <td><span class="btn btn-danger">Đã hủy</span></td>
                            @break
                        @default
                            <td><span class="btn btn-success">Hoàn thành</span></td>
                    @endswitch
                    <td><button type="submit" class="btn btn-info btn-details" id="{{ $value->book_id }}">Xem chi tiết</button></td>

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
                }
            });

        });

        $('.btn-close').on('click',function(){
        alert('2');
        });
        $(document).on('click', '.btn-close', function(){
            $('#modal-details').hide();

});

    });
</script>
