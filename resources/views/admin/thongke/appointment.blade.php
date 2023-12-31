     <!-- Recent Sales -->
     {{-- <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Thống kê truy cập</h5>

            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">Đang online</th>
                  <th scope="col">Tổng tháng trước</th>
                  <th scope="col">Tổng tháng này</th>
                  <th scope="col">Tổng một năm</th>
                  <th scope="col">Tổng truy cập</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><a href="#">#2457</a></th>
                  <td>Brandon Jacob</td>
                  <td><a href="#" class="text-primary">At praesentium minu</a></td>
                  <td>$64</td>
                  <td><span class="badge bg-success">Hoàn thành</span></td>
                </tr>
              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Recent Sales -->
 --}}


<!-- Recent Sales -->
     <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" href="#">Hôm nay</a></li>
              <li><a class="dropdown-item" href="#">Tháng này</a></li>
              <li><a class="dropdown-item" href="#">Năm nay</a></li>
            </ul>
          </div>

          <div class="card-body">
            <h5 class="card-title">Danh sách đơn lịch gần đây <span>| Hôm nay</span></h5>

            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Khách hàng</th>
                  <th scope="col">Dịch vụ</th>
                  <th scope="col">Tổng tiền</th>
                  <th scope="col">Trạng thái</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($book as $key=> $val )
                    <tr>
                        <th scope="row"><a href="#">{{ $val->book_id }}</a></th>
                        <td>{{ $val->name }}</td>
                        <td><a href="#" class="text-primary">{{ $val->service_name }}</a></td>
                        <td>{{ number_format($val->book_total) }} đ</td>
                        @switch($val->book_status)
                            @case(1)
                                 <td><span class="badge bg-warning">Đơn lịch mới</span></td>

                            @break
                            @case(2)
                                 <td><span class="badge bg-primary">Chưa hoàn thành</span></td>

                            @break
                            @case(3)
                                <td><span class="badge bg-danger">Đã hủy</span></td>
                            @break

                            @default
                            <td><span class="badge bg-success">Hoàn thành</span></td>
                            @break

                        @endswitch
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Recent Sales -->
