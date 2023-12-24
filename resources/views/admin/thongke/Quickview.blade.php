 <!-- Sales Card -->
 <div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
      <div class="card-body">
        <h5 class="card-title">Tổng đơn lịch</h5>

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
      <div class="card-body">
        <h5 class="card-title">Tổng doanh thu</h5>
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
      <div class="card-body">
        <h5 class="card-title">Tổng tài khoản khách hàng</h5>
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
