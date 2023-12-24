@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách tài khoản khách hàng</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col"></th>
                    </tr>
                </tr>
              </thead>
              <tbody>
                @foreach ($member as $key => $val)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><img src="
                        @if (empty($val->image))
                    {{ asset('admin/assets/img/apple-touch-icon.png' )}}

                    @else
                    {{ asset('uploads/users/'.$val->image )}}
                    @endif" alt="" style="width: 80px;height: 80px;"></td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->email }}</td>
                    <td>{{ $val->shipping_address }}</td>
                    <td><a href="{{ route('admin.Nguoi-dung.show',$val->user_id) }}">Xem chi tiết</a></td>
                    <td><div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href=""
                            ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                        >

                        <form action="" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Xóa</button>
                        </form>
                        </div>
                    </div></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>
        <a href="" class="btn btn-primary">Thêm tài khoản người giúp việc</a>
      </div>
    </div>
  </section>

@endsection
