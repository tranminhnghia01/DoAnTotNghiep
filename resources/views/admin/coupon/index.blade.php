@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách</h5>

            <table class="table datatable">
              <thead>
                <tr>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Mã</th>
                    <th scope="col">Phương thức giảm giá</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                </tr>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                    @php
                        $today = date('Y-m-d',strtotime(now()));
                    @endphp
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->coupon_name }}</td>
                        <td>{{ $value->coupon_code }}</td>
                        <td>
                            @if ($value->coupon_method == 0)
                                {{ $value->coupon_number }}%
                            @else
                                {{ number_format($value->coupon_number) }} <sup>đ</sup>
                            @endif
                        </td>
                        <td>{{ $value->coupon_time_start }}</td>
                        <td>{{ $value->coupon_time_end }}</td>
                        <td>

                            @if ($value->coupon_time_end < $today)
                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Hết hạn</span>

                            @else
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Còn hạn</span>
                            @endif

                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.coupon.edit',$value->coupon_id) }}"
                                    ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                                >

                                <form action="{{ route('admin.coupon.destroy',$value->coupon_id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Xóa</button>
                                </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
            <div class="col-xxl">
                <div class="card mb-4">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                    @if (isset($coupon->coupon_id))
                        Cập nhật
                    @else
                        Thêm mới
                    @endif mã giảm giá</h5>
                  </div>
                  <div class="card-body ">
                    @if (isset($coupon->coupon_id))
                        @include('admin.coupon.edit')
                    @else
                        @include('admin.coupon.create')
                    @endif
                  </div>
                </div>
              </div>
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
