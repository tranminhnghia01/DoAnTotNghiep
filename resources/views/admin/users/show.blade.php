@extends('admin.layouts.app')
@section('container')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            @if (empty($housekeeper->image))
                <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" class="rounded-circle">
            @else
                <img src="{{ asset('uploads/users/'.$housekeeper->image) }}" alt="Profile" class="rounded-circle">
            @endif
            <h2> {{ $housekeeper->name }} </h2>
            <h3></h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng quan</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Chỉnh sửa hồ sơ</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#content-edit">Giao diện chi tiết</button>
              </li>
            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Tổng quan</h5>
                <p class="small fst-italic">{{ $housekeeper->des }}</p>

                <h5 class="card-title">Chi tiết hồ sơ</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Vai trò</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->role_name }}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->address }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->email }}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                @include('admin.users.setting')
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="content-edit">
                <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Chi tiết</h5>
                        <!-- TinyMCE Editor -->
                        <form action="{{ route('admin.housekeeper.showfe',$housekeeper->housekeeper_id) }}" method="POST">
                            @csrf
                            <textarea class="form-control" name="content" id="content">
                                 {!! $housekeeper->content !!}
                            </textarea><!-- End TinyMCE Editor -->
                            <button type="submit"> Xác nhận</button>
                        </form>
                      </div>
                    </div>

                  </div>
              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách đơn lịch</h5>
            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table datatable" >
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Ngày bắt đầu làm việc</th>
                            <th>Tổng hóa đơn</th>
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
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->shipping_name }}</td>
                                <td>{{ $value->book_address }}</td>

                                    <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $value->book_time_start }}</td>

                                <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>

                                @switch($value->history_status)
                                    @case(1)
                                        <td><span class="btn btn-warning" style="color: white;width: 170px;">Đang đợi xác nhận</span></td>
                                        @break
                                    @case(2)
                                        <td><span class="btn btn-primary" style="color: white;width: 170px;">Chưa hoàn thành</span></td>
                                        @break
                                    @case(3)
                                        <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                        @break
                                    @default
                                        <td><span class="btn btn-success" style="color: white;width: 170px;">Hoàn thành</span></td>
                                @endswitch
                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}">Xem nhanh</button></td>


                            </tr>
                            @endforeach
                        <div id="modal-details"></div>
                    </tbody>
                </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
