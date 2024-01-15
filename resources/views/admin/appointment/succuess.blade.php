
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="table-responsive">
      <table class="table datatable" style="text-align: center">
          <thead>
              <tr>
                  <th>STT</th>
                  <th>Người nhận</th>
                  <th>Người đặt</th>
                  <th>Ngày bắt đầu làm việc</th>
                  <th>Dịch vụ</th>
                  <th>Tổng hóa đơn</th>
                  <th> </th>

              </tr>
          </thead>
          <tbody>
              {{-- @if (!empty($book)) --}}
                  @foreach ($bill as $key=>$value )
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
                  @if ($value->history_status == 2)
                      <tr>
                          <td>{{ $key+1}}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->shipping_name }}</td>
                          <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start.' - '. $time_end}}</td>
                          <td>{{ $value->service_name }}</td>
                          <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                          <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>
                      </tr>
                  @endif

                  @endforeach
                  {{-- @else
                      <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

              @endif --}}
          </tbody>
      </table>
      </div>
  </div>
