@extends('admin.layouts.app')
@section('container')
<section class="section dashboard">
    <div class="row">
        {{-- <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Thống kê</h5>

                <!-- Browser Default Validation -->
                <form class="row g-3">
                  <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">Từ ngày:</label>
                    <input type="date" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label for="validationDefault02" class="form-label">Đến ngày:</label>
                    <input type="date" class="form-control">

                  </div>
                  <div class="col-md-3">
                    <label for="validationDefault04" class="form-label">Lọc theo:</label>
                    <select class="form-select" id="validationDefault04">
                        <option selected="" disabled="" value="">Choose...</option>
                        <option value="1">Hôm nay</option>
                        <option value="2">Tháng này</option>
                        <option value="3">Năm này</option>
                    </select>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary" type="submit">Lọc kết quả</button>
                  </div>
                </form>
                <!-- End Browser Default Validation -->
              </div>
            </div>
        </div> --}}
        @include('admin.thongke.Quickview')

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                <h5 class="card-title">Thời gian</h5>

                    <form class="row g-3" autocomplete="off">
                        @csrf
                        <div class="col-md-4">
                          <label for="validationDefault01" class="form-label">Từ ngày:</label>
                          <input type="date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label for="validationDefault02" class="form-label">Đến ngày:</label>
                          <input type="date" name="to_date" class="form-control">

                        </div>
                        <div class="col-md-3">
                          <label for="validationDefault04" class="form-label">Lọc theo:</label>
                          <select class="form-select dashboard-filter" id="validationDefault04">
                              <option selected="" disabled="" value="">Chọn...</option>
                              <option value="7ngay">7 ngày qua</option>
                              <option value="thangtruoc">Tháng trước</option>
                              <option value="thangnay">Tháng này</option>
                              <option value="365ngay">1 năm qua</option>
                          </select>
                        </div>

                        <div class="col-12">
                          <button type="button" class="btn btn-primary btn-dashboard-filter">Lọc kết quả</button>
                        </div>
                      </form>



                  </div>
                </div>
            </div>
          <!-- Reports -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Biểu đồ tăng trưởng</h5>
                <!-- Line Chart -->
                <div id="myfirstchart" style="width: 100%;height: 300px;">

                </div>


                <!-- End Line Chart -->

              </div>

            </div>
          </div><!-- End Reports -->


            @include('admin.thongke.appointment')
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-6">
         <!-- Website Traffic -->
         <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Tổng đơn lịch, dịch vụ bài viết trên Hệ thống</h5>

              <div id="donut" style="min-height: 400px;" class="echart">


              </div>
            </div>
          </div><!-- End Website Traffic -->
      </div><!-- End Right side columns -->

      <div class="col-lg-6">
        @include('admin.thongke.customer')

        @include('admin.thongke.service')
      </div><!-- End Right side columns -->

      <div class="col-lg-6">

        <!-- News & Updates Traffic -->
        {{-- <div class="card">
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
            <h5 class="card-title">News &amp; Updates <span>| Hôm nay</span></h5>

            <div class="news">
              <div class="post-item clearfix">
                <img src="assets/img/news-1.jpg" alt="">
                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/news-2.jpg" alt="">
                <h4><a href="#">Quidem autem et impedit</a></h4>
                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/news-3.jpg" alt="">
                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/news-4.jpg" alt="">
                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/news-5.jpg" alt="">
                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
              </div>

            </div><!-- End sidebar recent posts-->

          </div>
        </div><!-- End News & Updates --> --}}
      </div><!-- End Right side columns -->

    </div>
  </section>
@endsection
