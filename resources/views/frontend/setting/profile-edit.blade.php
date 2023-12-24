<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 bg-light" >
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($shipping->shipping_image)
                        <img src="{{ asset('uploads/users/'.$shipping->shipping_image) }}" alt="Profile" class="rounded-circle" style="width: 250px">
                    @else
                        <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" class="rounded-circle">
                    @endif
                        <h2> {{ $shipping->shipping_name }} </h2>
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
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" >
                <div class="rounded p-5" style="background-color: #fff; padding-bottom: 3rem;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Hồ sơ</p>
                    <h1 class="mb-4">Thông tin cá nhân</h1>
                    <form action="{{ route('home.Account.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12" style="">
                                @if ($shipping->shipping_image)
                                <img src="{{ asset('uploads/users/'.$shipping->shipping_image) }}" alt="Profile" style="margin: 0 auto;display: flex;
                                justify-content: center;width: 250px;height: 200px">
                            @else
                                <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" style="margin: 0 auto;display: flex;
                                justify-content: center;">
                            @endif
                            <div class="pt-2" style="margin: 0 auto;display: flex;
                            justify-content: center;">
                                <label for="uploadImage" class="btn btn-primary btn-sm" title="Upload new profile image" style="color: #fff">
                                    <i class="bi bi-upload" style="font-size: 16px"><input type="file" name="shipping_image" id="uploadImage" accept="image/png, image/jpeg" hidden=""></i></label>
                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" style="margin-left: 40px;"><i class="bi bi-trash"style="font-size: 16px"></i></a>
                            </div>
                            @error('shipping_image')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                         </div>
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
