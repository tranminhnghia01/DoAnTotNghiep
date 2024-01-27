@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Chi tiết</h5>
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Người hẹn</th>
                                <th>Địa chỉ</th>
                                <th>Ngày bắt đầu làm việc</th>
                                <th>Dịch vụ</th>
                                <th>Tổng hóa đơn</th>
                                <th>Thanh toán</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                     $time= explode(':',$book->book_time_start);
                                     $time_end = $time[0]+ $book->book_time_number.':'.$time[1];
                                     $weekday = [
                                        'Monday' => 'Thứ 2',
                                        'Tuesday' => 'Thứ 3',
                                        'Wednesday' => 'Thứ 4',
                                        'Thursday' => 'Thứ 5',
                                        'Friday' => 'Thứ 6',
                                        'Saturday' => 'Thứ 7',
                                        'Sunday' => 'Chủ nhật',
                                    ];
                                        $date =  explode(",",$book->book_date);
                                            $changedate = explode("/",$date[0]);
                                             $date[0] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
                                @endphp
                                <tr>
                                    <td>{{ $book->shipping_name }}</td>
                                    <td>{{ $book->book_address }}</td>
                                        <td>{{ $weekday[date('l',strtotime($date[0]))].', '. date('d/m/Y',strtotime($date[0])).' - '. $book->book_time_start }}</td>

                                        <td>{{ $book->service_name }}</td>


                                    <td>{{ number_format($book->book_total) }} <sup>đ</sup> </td>
                                    <td>
                                        @if ($book->payment_id == 1)
                                            <span class="badge border-success border-1 text-success">Chưa thanh toán</span>
                                        @else
                                            <span class="badge border-success border-1 text-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $book->book_id }}"><i class="bi bi-eye"></i></a></button></td>


                                </tr>
                            <div id="modal-details"></div>
                        </tbody>
                    </table>
                </div>

                <div class="row g-3">
                    @php
                        $numberday = 0;
                    @endphp
                    @foreach ($checkhisbook as $keyC => $valC  )
                    <div class="col-sm-3">
                        <h5 class="modal-title">Thông tin lý do hủy</h5>
                        <div style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                            <img src="{{ asset('uploads/users/'.$valC->image) }}" alt="Girl in a jacket" width="150px" height="150px">
                        </div>
                        <div style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                        <p style="font-weight: 600"> {{ $valC->name }} </p>
                        <p> Mã người giúp việc: {{ $valC->housekeeper_id }} </p>
                        <p style="color: red"> Lý do hủy: {{ $valC->history_notes }} </p>
                    </div>
                    </div>
                        @php
                             $numberday += $valC->date_finish + $valC->history_previouse_date;
                        @endphp
                        {{-- {{$valC->housekeeper_id }} đã hủy đơn lịch trên  --}}
                    @endforeach
                </div>
                {{-- <p>{{ $numberday }}</p> --}}
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
    <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tìm kiếm người giúp việc</h5>
            <form class="row g-3" id="search-confirm">
                <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingEmail"  name="book_id" value="{{ $book->book_id }}" readonly>
                      <label for="floatingEmail">Mã đơn lịch</label>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingEmail" placeholder="Mã người giúp việc" name="search_housekeeper_id">
                      <label for="floatingEmail">Mã giúp việc</label>
                    </div>
                  </div>

                <div class="col">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email" name="keywords">
                    <label for="floatingEmail">Từ khóa tên</label>
                  </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingSelect" aria-label="State" name="gender">
                        <option selected value="">Tất cả</option>
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                      </select>
                      <label for="floatingSelect">Giới tính</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="select-age-start" name="age_start">
                        <option selected value="18">18</option>
                      </select>
                      <label for="floatingSelect">Tuổi</label>
                    </div>
                </div>
                <div style="width: 60px !important;padding: 15px ;10px">
                      <p>đến</p>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="select-age-end" name="age_end">
                        <option selected value="40">40</option>
                      </select>
                      <label for="floatingSelect">Tuổi</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <button type="button" class="btn btn-primary btn-search-confirm" style="height: 100%;padding: 15px;"><i class="bi bi-search"></i>Tìm kiếm</button>
                        <button type="reset" class="btn btn-default" style="height: 100%;    padding: 15px;">Làm mới</button>
                    </div>
                </div>



              </form>

            <h5 class="card-title">Danh sách người giúp việc</h5>

            <div class="table-responsive">
                <table class="table datatable" style="text-align: center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã người giúp việc</th>
                            <th>Tên</th>
                            <th>Giới tính</th>
                            <th>Tuổi</th>
                            <th>Tổng đơn đã nhận trong tháng này</th>
                            <th>Tình trạng</th>
                            <th></th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody id="list-search-confirm">
                        {{-- @if (!empty($book)) --}}
                        @php
                                $status = [];

                            @endphp
                            @foreach ($housekeeper as $key=>$value )
                            @php
                                $status[$key] = 0;
                                  $total = 0;
                            @endphp
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->housekeeper_id }}</td>
                                <td>{{ $value->name }}</td>
                                @if ($value->gender == 0)
                                        <td>Nữ</td>
                                    @else
                                        <td>Nam</td>
                                    @endif
                                <td>{{ $value->age }}</td>
                                @foreach ($history as $keyt =>$valt )
                                    @if ($valt->housekeeper_id == $value->housekeeper_id)
                                        @php
                                            $total = $valt->total;
                                        @endphp
                                    @endif

                                @endforeach
                                <td><span style="color: green">{{ $total }}</span></td>


                                @foreach ($check_day as $check => $valcheck)
                                    @php
                                        $datecheck =  explode(",",$valcheck->book_date);
                                        $date =  explode(",",$book->book_date);
                                    @endphp
                                    @if ($valcheck->housekeeper_id == $value->housekeeper_id)
                                        @for ($i = $numberday; $i < count($date); $i++)
                                            @if (in_array($date[$i], $datecheck))
                                                @php
                                                    $status[$key] = 1;
                                                @endphp
                                            @endif

                                        @endfor
                                    @endif
                                @endforeach
                                @if ($status[$key] == 1)
                                    <td><span style="color: red">Trùng lịch</span></td>
                                    <td><button class="btn btn-default">Giao công việc</button></td>

                                @else
                                    <td><span style="color: green">Không trùng lịch</span></td>
                                    <td>
                                        <form action="{{ route('admin.appointment.post-confirm',$book->book_id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="housekeeper_id" value="{{ $value->housekeeper_id }}">
                                            <button type="submit" class="btn btn-primary">Giao công việc</button>
                                        </form>
                                    </td>

                                @endif
                                <td><a href="{{ route('admin.housekeeper.show',$value->housekeeper_id) }}" class="btn btn-default">Xem chi tiết</td>
                            </tr>
                            @endforeach
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

