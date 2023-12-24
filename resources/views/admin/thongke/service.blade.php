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
            <h5 class="card-title">Dịch vụ thường xuyên<span>| Hôm nay</span></h5>

            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Tên</th>
                  <th scope="col">Số đơn lịch</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($count_service as $keyc=>$valc)
                    @foreach ($service as $key=>$val )
                        @if ($valc->service_id == $val->service_id)
                        <tr>
                            <th scope="row"><a href="#"><img src="{{ asset('uploads/services/'.$val->service_image) }}" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">{{ $val->service_name }}</a></td>
                            <td> {{ $valc->count_service }} </td>
                          </tr>
                        @endif
                    @endforeach
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Top Selling -->
