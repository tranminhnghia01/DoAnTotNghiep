@extends('admin.layouts.app')
@section('container')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            @if (empty($housekeeper->image))
                <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" class="rounded-circle">
            @else
                <img src="{{ asset('uploads/users/'.$housekeeper->image) }}" alt="Profile" class="rounded-circle">
            @endif
            <h2> {{ $housekeeper->name }} </h2>
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
            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Tổng quan</h5>
                <p class="small fst-italic">{{ $housekeeper->des }}</p>

                <h5 class="card-title">Chi tiết hồ sơ</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Vai trò</div>
                  <div class="col-lg-9 col-md-8">{{ $role->role_name }}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->address }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                  <div class="col-lg-9 col-md-8">{{ $housekeeper->phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                @include('admin.users.setting')
              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
