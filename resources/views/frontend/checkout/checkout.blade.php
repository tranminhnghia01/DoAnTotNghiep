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
                <div class="rounded p-5" style="background-color: #fff; padding-bottom: 3rem;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Hồ sơ</p>
                    <h1 class="mb-4">Thông tin cá nhân</h1>
                    <form method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="shipping_name" placeholder="Họ tên" value="{{ $shipping->shipping_name }}">
                                    <label for="email">Họ tên người nhận</label>
                                </div>
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                     <input type="email" class="form-control" id="email" name="shipping_email" placeholder="Email" value="{{ $shipping->shipping_email }}">
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="shipping_phone" value="{{ $shipping->shipping_phone }}">
                                    <label for="phone">Số điện thoại</label>
                                </div>
                                @error('phone')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-floating">
                                    <select id="city"  class="form-select  choose city" >
                                        <option ></option>
                                        @foreach ($city as $item)
                                              <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="city">Tỉnh-Thành phố</label>
                               </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-floating">
                                    <select id="province" class="form-select  choose province">
                                    </select>
                                      <label for="city">Quận-Huyện</label>
                               </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-floating">
                                    <select id="ward"  class="form-select ward">
                                        <option value=""></option>
                                    </select>
                                      <label for="city">Xã-Phường</label>
                               </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="address"  name="shipping_address" value="{{$shipping->shipping_address}}">
                                    <label for="address">Vị trí đã lưu</label>
                                </div>
                                @error('address')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button class="btn btn-orange w-100 py-3" type="submit">Xác nhận địa chỉ</button>
                            </div>
                        </div>
                    </form><!-- END -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
