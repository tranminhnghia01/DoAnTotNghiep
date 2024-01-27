{{-- @extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Danh sách</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="">Ảnh</th>
                        <th scope="col">Họ tên</th>
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

@endsection --}}


@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Ý kiến phản hồi khách hàng</h5>

            <!-- Table with stripped rows -->
            <div class="card card-body">
                <div class="table-responsive">
                  <table class="table search-table v-middle">
                    <thead class="header-item">
                      <tr><th>
                        <div class="n-chk align-self-center text-center">
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input secondary" id="contact-check-all">
                            <label class="form-check-label" for="contact-check-all"></label>
                            <span class="new-control-indicator"></span>
                          </div>
                        </div>
                      </th>
                      <th>Hình ảnh</th>
                      <th>Họ tên</th>
                      <th>Tuổi</th>
                      <th>Sđt</th>
                      <th>Địa chỉ</th>
                      <th>Trạng thái</th>
                      <th>Tùy chọn</th>
                    </tr></thead>
                    <tbody>
                      <!-- row -->
                      @foreach ($housekeeper as $key=>$value )
                      <tr class="search-items">
                        <td>
                          <div class="n-chk align-self-center text-center">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox1">
                              <label class="form-check-label" for="checkbox1"></label>
                            </div>
                          </div>
                        </td>
                        <td><img src="
                            @if (empty($val->image))
                        {{ asset('admin/assets/img/apple-touch-icon.png' )}}

                        @else
                        {{ asset('uploads/users/'.$val->image )}}
                        @endif" alt="" style="width: 80px;height: 80px;"></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0 font-weight-medium" data-name="Emma Adams">
                                  {{ $value->name }}
                                </h6>
                                {{-- <small class="user-work text-muted" data-occupation="Web Developer">Web Developer</small> --}}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                            <span class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $value->age }}</span>
                          </td><td>
                            <span class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $value->phone }}</span>
                          </td><td>
                            <span class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $value->address }}</span>
                          </td>
                        <td>
                            <span class="btn btn-success">Duyệt</span>
                          </td>
                        <td>
                          <div class="action-btn">
                            <a class="text-info edit btn-contact-reply" href="{{ route('admin.housekeeper.show',$value->housekeeper_id) }}" data-contact_id="{{ $value->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                            <a class="text-dark delete ms-2" href="{{ route('admin.housekeeper-destroy',$value->housekeeper_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            {{-- href="{{ route('admin.housekeeper-destroy',$value->housekeeper_id) }}"  --}}
                        </div>
                        </td>
                      </tr>
                      @endforeach

                      <!-- /.row -->
                    </tbody>
                  </table>
                </div>
              </div>

            <!-- End Table with stripped rows -->

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
