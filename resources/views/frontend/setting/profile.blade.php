@extends('frontend.setting.account')
@section('content-booking')
<div class="card">
    <div class="card-body">
        <h5 class="card-title"></h5>
        <table class="table datatable">
        <thead>
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

@endsection
