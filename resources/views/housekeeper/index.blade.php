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
                            <th>Ngày làm việc</th>
                            <th>Đã hoàn thành(Buổi)</th>
                            <th>Thanh toán</th>
                            <th>Ý kiến khách hàng</th>
                            <th>
                                <div style="display: flex;justify-content: space-around">
                                    <p>Ghi chú</p>
                                    <p>Thao tác</p>
                                </div>

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
                            @if ($value->book_status == 2)
                                @php
                                    $today = $value->date_finish;
                                    $date= explode(",",$value->book_date);

                                    for ($i=0; $i <count($date) ; $i++) {
                                        $changedate = explode("/", $date[$i]);
                                        $date[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                        $date[$i] =  (int ) strtotime($date[$i]);

                                    };
                                    sort($date);
                                    for ($i=0; $i <count($date) ; $i++) {
                                        $day[$i] = date('d/m/Y', $date[$i]);
                                    };
                                @endphp
                            <tr>
                                <td>{{ $key+1}}</td>

                                <td>{{ (($day[$today])).' - '. $value->book_time_start }}</td>
                                <td>{{ $value->date_finish }}/{{ Count($date) }}</td>
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
                                <td>
                                    <form action="{{ route('admin.Appoin-ChamCong',$value->book_id) }}" method="GET">
                                        <div  style="display: flex;width: 400px;justify-content:space-between">
                                            <textarea type="text" name="history_notes" style="margin-right: 20px;border:1 px soid #ccc;outline: #ccc;font-size: 12px">{{ $value->history_notes }}</textarea>
                                            @if ($value->service_id == 2 && $value->payment_id == 1)
                                            <button class="btn btn-secondery">Hoàn thành công việc</button>
                                            @else
                                                <button type="submit"  class="btn btn-success">Hoàn thành công việc</button>
                                            @endif
                                        </div>
                                    </form>
                            </td>

                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}" data-action="book_cance">Xem chi tiết</button></td>


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


