@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Danh sách</h5>

              <!-- Default Tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Chưa duyệt</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Đã duyệt</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Đơn hủy</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive">
                        <table class="table datatable" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn lịch</th>
                                    <th>Người đăng việc</th>
                                    <th>Ngày bắt đầu làm việc</th>
                                    <th>Dịch vụ</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
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
                                    @if ($value->book_status == 1)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $value->book_id }}</td>
                                        <td>{{ $value->shipping_name }}</td>

                                            <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start}}  </td>

                                        <td>{{ $value->service_name }}</td>
                                        <td>{{ number_format($value->book_total) }} <sup>đ</sup></td>

                                        <td><a href="{{ route('admin.appointment.confirm',$value->book_id) }}" class="btn btn-primary">Xác nhận
                                            @foreach ($bill as $keys )
                                            @if ($keys->book_id == $value->book_id)
                                                lại công việc
                                                @break
                                            @endif
                                        @endforeach
                                        </a></td>
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
                @include('admin.appointment.succuess')
                @include('admin.appointment.destroy')
              </div><!-- End Default Tabs -->
              <div id="modal-details"></div>

            </div>
          </div>
    </div>
  </section>

@endsection

