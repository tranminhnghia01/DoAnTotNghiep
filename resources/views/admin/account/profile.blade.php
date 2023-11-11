@extends('admin.layouts.app')
@section('container')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{asset('uploads/users/'.$user->image)}}" alt="Profile" class="rounded-circle">
            <h2> {{ $user->name }} </h2>
            <h3></h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng quan</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Chỉnh sửa hồ sơ</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Cài đặt</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Thay đổ mật khẩu</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Tổng quan</h5>
                <p class="small fst-italic">{{ $user->des }}</p>

                <h5 class="card-title">Chi tiết hồ sơ</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                  <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Công ty</div>
                  <div class="col-lg-9 col-md-8"> {{ $user->company }} </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Vai trò</div>
                  <div class="col-lg-9 col-md-8">{{ $role->role_name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Thành phố</div>
                  <div class="col-lg-9 col-md-8">@if ($country != null)
                    {{ $country->city_name }}
                  @endif</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                  <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                  <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.account.update') }}" >
                    @csrf
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh nền</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{asset('uploads/users/'.$user->image)}}" alt="Profile">
                      <div class="pt-2">
                        <label for="uploadImage"  class="btn btn-primary btn-sm" title="Upload new profile image" style="color: #fff">
                            <i class="bi bi-upload"><input type="file" name="image" id="uploadImage"  accept="image/png, image/jpeg" hidden /></i></label>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ tên</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="name" value="{{ $user->name }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Mô tả</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="des" class="form-control" id="about" style="height: 100px">{{ $user->des }}</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Công ty</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="company" type="text" class="form-control" id="company" value="{{ $user->company }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vị trí</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="role_name" type="text" class="form-control" id="Job" value="{{ $role->role_name }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
                    {{-- <div class="col-md-8 col-lg-9">
                      <select name="" id="">
                        <option value="">1</option>
                        <option value="">1</option>
                        <option value="">1</option>
                        <option value="">1</option>
                      </select>
                    </div> --}}
                      <div class="col-md-3">
                        <select id="city" name="city_id"  class="form-select  choose city" >
                          <option >Thành phố...</option>
                          @foreach ($city as $item)
                                <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-md-3">
                        <select id="province" name="province_id" class="form-select  choose province">
                        </select>
                      </div>
                      <div class="col-md-3">
                        <select id="ward" name="ward_id" class="form-select ward">
                            <option value="">{{  $user->ward_id }}</option>
                        </select>
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Chi tiết</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="address" value="A108 Adam Street, New York, NY 535022">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->name }}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Tuổi</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="age" type="number" class="form-control" id="phone" value="{{ $user->age }}">
                    </div>
                  </div>



                  </fieldset>
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Giới tính</label>
                    <div class="col-md-8 col-lg-9">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0" checked>
                            <label class="form-check-label" for="gridRadios1">
                              Nam
                            </label>

                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="1">
                            <label class="form-check-label" for="gridRadios2">
                              Nữ
                            </label>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter hồ sơ</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook hồ sơ</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram hồ sơ</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin hồ sơ</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
