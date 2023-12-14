@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách đơn lịch</h5>
            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table datatable" style="text-align: center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Ngày bắt đầu làm việc</th>
                            <th>Dịch vụ</th>
                            <th>Đã hoàn thành(Buổi)</th>
                            <th>Tổng hóa đơn</th>
                            <th>Httt</th>
                            <th>Trạng thái</th>
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
                            @if ($value->book_status ==4 || $value->book_status ==3)
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->shipping_name }}</td>
                                <td>{{ $value->book_address }}</td>
                                    <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start }}</td>

                                    <td>{{ $value->service_name }}</td>
                                    <td>{{ $value->date_finish }}/1</td>


                                <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                                <td>{{ $value->payment_method }} </td>

                                @switch($value->book_status)
                                    @case(3)
                                        <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                        @break
                                    @default
                                        <td><span class="btn btn-primary" style="color: white;width: 170px;">Đã hoàn thành</span></td>
                                @endswitch
                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}">Xem chi tiết</button></td>


                            </tr>
                            @endif

                            @endforeach
                            {{-- @else
                                <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

                        @endif --}}
                        <div id="modal-details"></div>
                    </tbody>
                </table>
            </div>

            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection



