@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="">Hình ảnh</th>
                  <th scope="col">Tên dịch vụ</th>
                  <th scope="col">Mô tả</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($services as $key => $val)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><img src="{{ asset('uploads/services/'.$val->service_image) }}" alt="" style="max-width: 150px; max-height: 150px;"></td>
                    <td>{{ $val->service_name }}</td>
                    <td class="role-4">{{ $val->service_des }}</td>
                    <td>@if ($val->service_status == "on")
                        <p class="badge bg-success">Kích hoạt</p>
                    @else
                        <p class="badge bg-warning">Đang phát triển</p>
                    @endif</td>
                    <td><div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.service.edit',$val->service_id) }}"
                            ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                        >

                        <form action="{{ route('admin.service.destroy',$val->service_id) }}" method="post">
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
