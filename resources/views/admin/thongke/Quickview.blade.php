 <!-- Sales Card -->
 <div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Lọc theo</h6>
              </li>

              <li><a class="dropdown-item total-book" href="#">Hôm nay</a></li>
              <li><a class="dropdown-item total-book" href="#">Tháng này</a></li>
              <li><a class="dropdown-item total-book" href="#">Năm này</a></li>
            </ul>
          </div>
      <div class="card-body">
        <h5 class="card-title">Tổng đơn lịch <span>| Hôm nay</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-cart"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $sum_book->total_booking }}</h6>
          </div>
        </div>
      </div>

    </div>
  </div><!-- End Sales Card -->

  <!-- Revenue Card -->
  <div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Lọc theo</h6>
              </li>

              <li><a class="dropdown-item total-sales" href="#">Hôm nay</a></li>
              <li><a class="dropdown-item total-sales" href="#">Tháng này</a></li>
              <li><a class="dropdown-item total-sales" href="#">Năm này</a></li>
            </ul>
          </div>
      <div class="card-body">
        <h5 class="card-title">Tổng doanh thu <span>| Hôm nay</span></h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="ps-3">
            <h6>{{ number_format($sum_book->total) }} đ</h6>

          </div>
        </div>
      </div>

    </div>
  </div><!-- End Revenue Card -->

  <!-- Customers Card -->
  <div class="col-xxl-4 col-xl-12">

    <div class="card info-card customers-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Lọc theo</h6>
              </li>

              <li><a class="dropdown-item total-profit" href="#">Hôm nay</a></li>
              <li><a class="dropdown-item total-profit" href="#">Tháng này</a></li>
              <li><a class="dropdown-item total-profit" href="#">Năm này</a></li>
            </ul>
          </div>

      <div class="card-body">
        <h5 class="card-title">Tổng Lợi nhuận <span>| Hôm nay</span> </h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-people"></i>
          </div>
          <div class="ps-3">
            <h6> {{ count($All_user) }} </h6>

          </div>
        </div>

      </div>
    </div>

  </div><!-- End Customers Card -->
