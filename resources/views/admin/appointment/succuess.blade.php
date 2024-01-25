
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="table-responsive">
      <table class="table datatable" style="text-align: center">
          <thead>
              <tr>
                  <th>STT</th>
                  <th>Mã hóa đơn</th>
                  <th>Mã đơn lịch</th>
                  <th>Người nhận</th>
                  <th>Người đặt</th>
                  <th>Dịch vụ</th>
                  <th>Tổng hóa đơn</th>
                  <th> </th>

              </tr>
          </thead>
          <tbody>
              {{-- @if (!empty($book)) --}}
                  @foreach ($bill as $key=>$value )
                  @if ($value->history_status == 2)
                      <tr>
                          <td>{{ $key+1}}</td>
                          <td>{{ $value->history_id }}</td>
                          <td>{{ $value->book_id }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->shipping_name }}</td>
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
