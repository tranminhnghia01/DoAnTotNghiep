@extends('admin.layouts.app')
@section('container')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" class="rounded-circle">
            <h2></h2>
            <h3></h3>
            <div class="social-links mt-2">
              <a  class="twitter"><i class="bi bi-twitter"></i></a>
              <a  class="facebook"><i class="bi bi-facebook"></i></a>
              <a  class="instagram"><i class="bi bi-instagram"></i></a>
              <a  class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Thông tin hồ sơ</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                   <!-- Profile Edit Form -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.housekeeper.store') }}" >
                    @csrf
                <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh nền</label>
                    <div class="col-md-8 col-lg-9">
                    <img class="profile-image" src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" style="width: 70px;">
                    <div class="pt-2">
                        <label for="uploadImage"  class="btn btn-primary btn-sm" title="Upload new profile image" style="color: #fff">
                            <i class="bi bi-upload"><input type="file" name="image" id="uploadImage"  accept="image/png, image/jpeg" hidden /></i></label>
                        <a  class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                    </div>
                    @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>

                <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ tên</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email">
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Mật khẩu (mặc định:12345678)</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password" type="password"  class="form-control" readonly value="12345678">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Mô tả</label>
                    <div class="col-md-8 col-lg-9">
                    <textarea name="des" class="form-control" id="about" style="height: 100px"></textarea>
                        @error('des')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vị trí</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="text" class="form-control" id="Job" value="{{ $role->role_name }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
                    <div class="col-md-3">
                        <select id="city"  class="form-select  choose city" >
                        <option >Thành phố...</option>
                        @foreach ($city as $item)
                                <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="province" class="form-select  choose province">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="ward"  class="form-select ward">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Chi tiết</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="address" >
                        @error('address')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone">
                        @error('phone')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Tuổi</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="age" type="number" class="form-control" id="phone" min="18" max="40" value="18">
                    </div>
                </div>



                </fieldset>
                <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Giới tính</label>
                    <div class="col-md-8 col-lg-9">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1">
                            <label class="form-check-label" for="gridRadios1">
                            Nam
                            </label>

                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="0" checked >
                            <label class="form-check-label" for="gridRadios2">
                            Nữ
                            </label>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
                    <div class="col-md-8">
                        <select    class="form-select  "  name="status">
                        <option selected value="0">Kích hoạt</option>
                        <option value="1">Vô hiệu hóa</option>
                        </select>
                    </div>
                  </div>


                <div class="row mb-3">
                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Ảnh CCCD</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="files" type="text" class="form-control" id="Linkedin"  multiple="multiple" value="0">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Xác nhận thêm</button>
                </div>
                </form>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
