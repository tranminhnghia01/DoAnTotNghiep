@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách người giúp việc</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Mã người giúp việc</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </tr>
              </thead>
              <tbody>
                @foreach ($housekeeper as $key => $val)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><img src="
                        @if (empty($val->image))
                    {{ asset('admin/assets/img/apple-touch-icon.png' )}}

                    @else
                    {{ asset('uploads/users/'.$val->image )}}
                    @endif" alt="" style="width: 80px;height: 80px;"></td>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->housekeeper_id }}</td>
                    <td>{{ $val->email }}</td>
                    <td>
                        @if ($val->status == 1)
                        <span class="badge border-danger text-danger" style="font-size: 16px">Chưa duyệt</span>
                    @else
                        <span class="badge border-success text-success" style="font-size: 16px">Đã duyệt</span>
                    @endif</td>
                    <td><a href="{{ route('admin.housekeeper.show',$val->housekeeper_id) }}">Xem chi tiết</a></td>
                    <td><div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.housekeeper.edit',$val->housekeeper_id) }}"
                            ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                        >

                        <form action="{{ route('admin.housekeeper.destroy',$val->housekeeper_id) }}" method="post">
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
          </div>
        </div>
        <a href="{{ route('admin.housekeeper.create') }}" class="btn btn-primary">Thêm tài khoản người giúp việc</a>
      </div>
    </div>
  </section>

@endsection
