@include('admin.layouts.header')
@if (session('msg'))
    <div class="alert alert-{{session('style')}}">
        {{ session('msg') }}
    </div>
@endif

<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">TRANG QUẢN TRỊ</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Tạo tài khoản</h5>
                    <p class="text-center small">Nhập thông tin cá nhân của bạn để tạo tài khoản</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="col-12">
                      <label for="yourName" class="form-label">Họ tên</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" required  value="{{ old('name') }}" >
                      <div class="invalid-feedback">Vui lòng nhập họ tên!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email địa chỉ</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourUsername" required value="{{ old('email') }}">
                        <div class="invalid-feedback">Vui lòng nhập địa chỉ email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mật khẩu</label>
                      <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password">
                      <div class="invalid-feedback">Nhập mật khẩu!</div>
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control  @error('password') is-invalid @enderror" id="password-confirm" required autocomplete="new-password" >
                        <div class="invalid-feedback">Nhập lại mật khẩu!</div>
                      </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Tôi đồng ý và chấp nhận <a href="">các điều khoản và điều kiện</a></label>
                        <div class="invalid-feedback">Bạn phải đồng ý trước khi gửi tạo tài khoản.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Tạo tài khoản</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Bạn đã có sẵn một tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


@include('admin.layouts.footer')
