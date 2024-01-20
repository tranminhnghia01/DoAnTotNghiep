@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách tài khoản khách hàng</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Mã tài khoản</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col"></th> --}}
                        <th scope="col"></th>
                    </tr>
                </tr>
              </thead>
              <tbody>
                @foreach ($member as $key => $val)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><img src="
                        @if ($val->shipping_image)
                    {{ asset('uploads/users/'.$val->shipping_image )}}

                    @else
                    {{ asset('admin/assets/img/apple-touch-icon.png' )}}

                    @endif" alt="" style="width: 80px;height: 80px;"></td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->user_id }}</td>
                    <td>{{ $val->email }}</td>
                    {{-- <td><a href="{{ route('admin.Nguoi-dung.show',$val->user_id) }}">Xem chi tiết</a></td> --}}
                    <td><div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href=""
                            ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                        >
                        <form action="{{ route('admin.Nguoi-dung.destroy',$val->id) }}" method="post">
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
      </div>
    </div>
  </section>

@endsection
