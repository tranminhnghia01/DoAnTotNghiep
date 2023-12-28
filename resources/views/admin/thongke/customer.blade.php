  <!-- Top Selling -->
  <div class="col-12">
    <div class="card top-selling overflow-auto">

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

      <div class="card-body pb-0">
        <h5 class="card-title">Khách hàng thường xuyên<span>| Hôm nay</span></h5>

        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Tên</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Số lần</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($count_appointmemt as $key => $val)
                @foreach ($getName as $val_name)
                    @if ($val_name->shipping_id == $val->shipping_id)
                <tr>

                    <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt="">{{ $key+1 }}</a></th>
                    <td><a href="#"class="text-primary fw-bold">{{$val_name->name}}</a></td>
                    <td class="fw-bold">{{ number_format($val->total) }} <sup>đ</sup></td>
                    <td>{{ $val->count_booking }}</td>
                </tr>

                    @endif
                @endforeach

            @endforeach
          </tbody>
        </table>

      </div>

    </div>
  </div><!-- End Top Selling -->
