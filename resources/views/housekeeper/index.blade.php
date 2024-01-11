@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách đơn lịch</h5>
            <!-- Table with stripped rows -->
            <div class="table-responsive"  style="min-height: 500px;">
                <table class="table datatable" style="text-align: center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Ngày làm việc</th>
                            <th>Đã hoàn thành(Buổi)</th>
                            <th>Thanh toán</th>
                            <th>Ý kiến khách hàng</th>
                            <th>
                                    <p>Thao tác</p>
                            </th>
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
                                    'Sunday' => 'CN',
                                ];


                            @endphp
                            @if ($value->history_status == 2)
                                @php
                                    $today = $value->date_finish+$value->history_previous_date;
                                    $date= explode(",",$value->book_date);

                                    for ($i=0; $i <count($date) ; $i++) {
                                        $changedate = explode("/", $date[$i]);
                                        $date[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                    };

                                @endphp
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->book_id}}</td>

                                <td>{{ (($date[$today])).' - '. $value->book_time_start }}</td>
                                <td>{{ $value->date_finish }}/{{ Count($date)-$value->history_previous_date }}</td>
                                <td>
                                @if ($value->service_id == 2)
                                    @if ($value->payment_id == 1)
                                        <span class="badge border-warning border-1 text-warning">Khách hàng chưa thanh toán</span>
                                    @else
                                        <span class="badge border-success border-1 text-success">Đã thanh toán</span>
                                    @endif
                                @else
                                @if ($value->payment_id == 1)
                                <span class="badge border-primary border-1 text-primary">Tiền mặt</span>
                            @else
                                <span class="badge border-success border-1 text-success">Đã thanh toán</span>
                            @endif
                                @endif
                            </td>
                                <td>{{ $value->book_notes }}</td>
                                <td><div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" style="widows: 100px">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <form action="{{ route('admin.Appoin-ChamCong',$value->book_id) }}" method="GET" style="    text-align: center;
                                        padding: 10px;
                                        width: 300px;
                                        border: 1px solid;
                                    ">
                                        <div>
                                            <p>Đánh giá công việc</p>
                                            <textarea type="text" name="history_notes" style="    outline: rgb(204, 204, 204);
                                            font-size: 14px;
                                            width: 100%;">{{ $value->history_notes }}</textarea>
                                            @if ($value->service_id == 2 && $value->payment_id == 1)
                                            <button style="width:100%" class="btn btn-secondery" disabled>Hoàn thành công việc</button>
                                            @else
                                                <button style="width:100%" type="submit"  class="btn btn-success">Hoàn thành công việc</button>
                                            @endif
                                        </div>
                                    </form>
                                    </div>
                                </div></td>
                                <td><a href="{{ route('admin.details-book.show',$value->history_id) }}" class="btn btn-default btn-booking-details" id="{{ $value->history_id }}">Xem chi tiết</a></td>
                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>
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


