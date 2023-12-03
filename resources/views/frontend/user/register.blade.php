@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 bg-light" >
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <h1 class="text-orange" style="width: 200px;">Moon.com</h1>
                    <p>Giờ đây, bạn không chỉ dễ dàng kiếm tiền từ việc giúp việc nhà theo giờ, mà còn chủ động về thời gian của bạn để cải thiện chất lượng cuộc sống.</p>
                    <img src="{{ asset('frontend/img/210721-partner-home-cleaning-dang-ky-doi-tac.png') }}" alt="" height="100%">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="max-width: 50%;padding-bottom: 3rem;">
                <div class="rounded p-5" style="background-color: #fff;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Đăng ký</p>
                    <h1 class="mb-4">Thông tin tài khoản</h1>
                    <form  action="{{ route('home.register') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên">
                                    <label for="email">Họ tên</label>
                                </div>
                                @error('name')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                     <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                                    <label for="password">Mật khẩu</label>
                                </div>
                                @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                  <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                  <label class="form-check-label" for="acceptTerms">Tôi đồng ý và chấp nhận <a href="#">các điều khoản và điều kiện</a></label>
                                  <div class="invalid-feedback">Bạn phải đồng ý trước khi gửi tạo tài khoản.</div>
                                </div>
                              </div>

                            <div class="col-12">
                                <button class="btn btn-orange w-100 py-3" type="submit">Đăng ký</button>
                            </div>

                        </div>
                    </form>
                        <p class="mt-20" style="margin-top: 16px;">Bạn đã có một tài khoản ?<a href="{{ route('home.login') }}"> Đăng nhập</a></p>
                        <p><a href="forget-password.html"> Quên mật khẩu?</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

