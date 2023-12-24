@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bảng giá</h5>

            <table class="table table-bordered border-primary ">
              <thead>
                <tr>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giờ làm</th>
                    <th scope="col">Thứ 2 - Thú 6</th>
                    <th scope="col">Thứ 7 - CN</th>
                    <th scope="col"></th>
                </tr>
                </tr>
              </thead>
              <tbody>
                @foreach ($service as $key => $val)
                @if ($key != 1)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $val->service_name }}</td>
                     <td>1h</td>
                     <td>{{ number_format($val->service_price) }} vnđ</td>
                     <td>{{ number_format($val->service_price+10000) }} vnđ</td>
                     <td>
                         <div class="dropdown">
                             <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                             <i class="bx bx-dots-vertical-rounded"></i>
                             </button>
                             <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{ route('admin.service.edit',$val->service_id) }}"
                                 ><i class="bx bx-edit-alt me-1"></i> Sửa </a >

                             </div>
                         </div>
                     </td>
                </tr>
                @else
                <tr>
                    <td rowspan="2">{{ $key+1 }}</td>
                    <td rowspan="2">{{ $val->service_name }}</td>
                    <td>2h</td>
                    <td>{{ number_format($val->service_price) }} vnđ</td>
                    <td>{{ number_format($val->service_price+10000) }} vnđ</td>

                     <td>
                         <div class="dropdown">
                             <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                             <i class="bx bx-dots-vertical-rounded"></i>
                             </button>
                             <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{ route('admin.service.edit',$val->service_id) }}"
                                 ><i class="bx bx-edit-alt me-1"></i> Sửa </a
                             >
                             </div>
                         </div>
                     </td>
                </tr>
                <tr>
                    <td>>2h</td>
                    <td>{{ number_format($val->service_price-10000) }} vnđ</td>
                    <td>{{ number_format($val->service_price) }} vnđ</td>
                     <td></td>
                </tr>
                @endif
                    @endforeach
              </tbody>
            </table>
         </div>

      </div>
    </div>
  </section>

@endsection


{{--


                <!-- Basic Layout -->

        </div>

    </div>

@endsection --}}
