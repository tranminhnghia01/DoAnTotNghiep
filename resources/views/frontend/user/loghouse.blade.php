@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 bg-light" >
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <h1 style="width: 200px;">Thu nhập nhiều hơn.
                        Cuộc sống tốt hơn.</h1>
                        <p>Giờ đây, bạn không chỉ dễ dàng kiếm tiền từ việc giúp việc nhà theo giờ, mà còn chủ động về thời gian của bạn để cải thiện chất lượng cuộc sống.</p>
                    <img src="{{ asset('frontend/img/210721-partner-home-cleaning-dang-ky-doi-tac.png') }}" alt="" height="100%">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" >
                <div class="rounded p-5" style="background-color: #fff; margin-top: -80px;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Đăng ký trở thành đối tác</p>
                    <h1 class="mb-4">Người giúp việc</h1>
                    <form  action="{{ route('home.housekeeper') }}" enctype="multipart/form-data" method="POST" >
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12" style="">
                                <div class="form-floating" >
                                    <input type="file" class="form-control" id="image" name="image" style="padding-top: 16px;
                                    background: #fff;">
                                </div>
                            @error('shipping_image')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                         </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" value="{{ Auth::user()->name }}">
                                    <label for="email">Họ tên</label>
                                </div>
                                @error('name')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                     <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly value="{{ Auth::user()->email }}">
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại">
                                    <label for="phone">Số điện thoại</label>
                                </div>
                                @error('phone')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="age" name="age" placeholder="Họ tên" min="18" max="40">
                                    <label for="age">Tuổi</label>
                                </div>
                                @error('age')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">
                                    <label for="address">Địa chỉ</label>
                                </div>
                                @error('address')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating" style="font-size: 16px;padding: 5px 12px;">
                                    <input type="radio"  id="Nu" name="gender" value="0">
                                    Nữ
                                    <input type="radio"  id="Nam" name="gender" value="1" style="margin-left: 20px">
                                    Nam
                                </div>
                                @error('address')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-12">
                                <div class="form-check">
                                    <input type="hidden" name="status" value="1">
                                  <input class="form-check-input" type="checkbox" value="" id="acceptTerms" required>
                                  <label class="form-check-label" for="acceptTerms">Tôi đồng ý việc đại diện từ Moon liên lạc với tôi thông qua số điện thoại hoặc Email mà tôi đăng ký.</label>
                                  <div class="invalid-feedback">Bạn phải đồng ý trước khi gửi tạo tài khoản.</div>
                                </div>
                              </div>
                            <div class="col-12">
                                <button class="btn btn-orange w-100 py-3" type="submit">Đăng ký nhận việc</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

