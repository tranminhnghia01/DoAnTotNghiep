@extends('admin.layouts.app')
@section('container')
<section class="section dashboard">
    <div class="row">
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

      <div class="row g-3 bg-white">
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

         {{-- Bài viết xem nhiều --}}
         <div class="col-lg-3">
            <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Bài viết xem nhiều</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Số lần</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($blog as $key => $val)
                          <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td><a class="text-primary fw-bold">{{$val->blog_title}}</a></td>
                              <td>{{ $val->blog_views }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
          </div><!-- End bài viết xem nhiều -->


         {{-- DỊch vụ xem nhiều --}}
          <div class="col-lg-3">
           <div class="card top-selling overflow-auto">
               <div class="card-body pb-0">
                 <h5 class="card-title">Dịch vụ xem nhiều </h5>

                 <table class="table table-borderless">
                   <thead>
                     <tr>
                       <th scope="col">STT</th>
                       <th scope="col">Tên</th>
                       <th scope="col">Số lần</th>
                     </tr>
                   </thead>
                   <tbody>
                     @foreach ($service as $key => $val)
                         <tr>
                             <th scope="row">{{ $key+1 }}</th>
                             <td><a class="text-primary fw-bold">{{$val->service_name}}</a></td>
                             <td>{{ $val->service_views }}</td>
                         </tr>
                     @endforeach
                   </tbody>
                 </table>

               </div>

             </div>
         </div><!-- Bài viết xem nhiều -->


      </div>
      <!-- Right side columns -->

      <div class="row g-3 bg-white">
        <div class="col-lg-6">
            @include('admin.thongke.customer')

        </div>
        <div class="col-lg-6">

            @include('admin.thongke.service')
          </div><!-- End Right side columns -->

        </div>


    </div>
  </section>
@endsection
