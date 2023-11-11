@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Mã giảm giá</h4>
        <div class="card">
            <h5 class="card-header">Mã giảm giá</h5>
              @if (session('msg'))
            <div class="alert alert-{{session('style')}}">
            {{ session('msg') }}
            </div>
         @endif
            <div class="table-responsive text-nowrap">
            <table class="table ">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Method</th>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $item => $value)
                    <tr>
                        <td>{{ $item+1 }}</td>
                        <td>{{ $value->coupon_name }}</td>
                        <td>{{ $value->coupon_code }}</td>
                        <td>{{ $value->coupon_method }}</td>
                        <td>{{ $value->coupon_number }}</td>
                        @if ($value->coupon_status == 0)
                            <td><span class="badge bg-label-success me-1">Kích hoạt</span></td>
                        @else
                        <td><span class="badge bg-label-danger me-1">Vô hiệu hóa</span></td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.coupon.edit',$value->id) }}"
                                    ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                                >

                                <form action="{{ route('admin.coupon.destroy',$value->id) }}" method="post">
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
            <div class="col-lg-12">
                <div class="demo-inline-spacing">
                  <nav aria-label="Page navigation">
                    <ul class="pagination  justify-content-end">
                    </ul>
                  </nav>
                </div>
            </div>
            </div>
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                      <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@if (isset($coupon->id))
                            Cập nhật
                        @else
                            Thêm mới
                        @endif mã giảm giá</h5>
                        <small class="text-muted float-end">Default</small>
                      </div>
                      <div class="card-body ">
                        @if (isset($coupon->id))
                        <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_name" placeholder="coupon name" value="{{ $coupon->coupon_name }}"/>
                              @error('coupon_name')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Code</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_code" placeholder="coupon code"  value="{{ $coupon->coupon_code }}"/>
                              @error('coupon_code')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Quantity</label>
                            <div class="col-sm-2">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_qty" placeholder="quantity" value="{{ $coupon->coupon_qty }}" />
                              @error('coupon_qty')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Method</label>
                            <div class="col-sm-2">
                                <select class="form-select" id="inputGroupSelect01" name="coupon_method">
                                    @if ($coupon->coupon_method == 0)
                                        <option selected value="0">%</option>
                                        <option value="1">Money</option>
                                    @else
                                        <option value="0">%</option>
                                        <option selected value="1">Money</option>
                                    @endif
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Number</label>
                            <div class="col-sm-2">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_number" placeholder=""  value="{{ $coupon->coupon_number }}"/>
                              @error('coupon_number')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Descriptons</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="coupon_des"  value="{{ $coupon->coupon_des }}" />
                              </div>
                              @error('coupon_des')
                              <span style="color: red">{{ $message }}</span>
                            @enderror
                              <div class="form-text">You can use letters, numbers & periods</div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message" >Content</label>
                            <div class="col-sm-10">
                              <textarea name="coupon_content" id="coupon_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" >{{ $coupon->coupon_content }}</textarea>
                              @error('coupon_content')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Options</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="inputGroupSelect01" name="coupon_status">
                                    @if ($coupon->coupon_status == 0)
                                        <option selected value="0">Kích hoạt</option>
                                        <option value="1">Vô hiệu hóa</option>
                                    @else
                                        <option value="0">Kích hoạt</option>
                                        <option selected value="1">Vô hiệu hóa</option>
                                    @endif
                                  </select>
                            </div>
                          </div>

                          <div class="row justify-content-end">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Xác  nhận</button>
                            </div>
                          </div>
                        </form>
                        @else

                        <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_name" placeholder="coupon name" />
                              @error('coupon_name')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Code</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_code" placeholder="coupon code" />
                              @error('coupon_code')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Number</label>
                            <div class="col-sm-2">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_qty" placeholder="quantity" />
                              @error('coupon_qty')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Method</label>
                            <div class="col-sm-2">
                                <select class="form-select" id="inputGroupSelect01" name="coupon_method">
                                    <option selected value="0">%</option>
                                    <option value="1">Money</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Number</label>
                            <div class="col-sm-2">
                              <input type="text" class="form-control" id="basic-default-name" name="coupon_number" placeholder="" />
                              @error('coupon_number')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Descriptons</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="coupon_des" />
                              </div>
                              @error('coupon_des')
                              <span style="color: red">{{ $message }}</span>
                            @enderror
                              <div class="form-text">You can use letters, numbers & periods</div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message" >Content</label>
                            <div class="col-sm-10">
                              <textarea name="coupon_content" id="coupon_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" ></textarea>
                              @error('coupon_content')
                                <span style="color: red">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Options</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="inputGroupSelect01" name="coupon_status">
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Vô hiệu hóa</option>
                                  </select>
                            </div>
                          </div>

                          <div class="row justify-content-end">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                          </div>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
        </div>

    </div>

@endsection
