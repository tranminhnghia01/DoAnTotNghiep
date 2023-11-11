@extends('frontend.user.dashboard')
@section('profile')
<div class="dashboard-wrapper dashboard-user-profile">
    <div class="media">
        <div class="pull-left text-center" href="#!">
        <img class="media-object user-img" src=" {{ asset('uploads/users/'.Auth::user()->avatar) }} " alt="Image" style="height: 180px">
        <a href="#x" class="btn btn-transparent mt-20">Change Image</a>
        </div>
        <div class="media-body">
        <form class="text-left clearfix" action="{{ route('home.account.update',$user->id) }}" enctype="multipart/form-data" method="POST">
            {{-- @method('PUT') --}}
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstname">Họ</label>
                    <input type="text" class="form-control" style="font-weight: 700" name="firstname" placeholder="First name" value="{{ $first_name }}">
                    @error('firstname')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastname">Tên</label>
                    <input type="text" class="form-control" style="font-weight: 700" name="lastname" placeholder="Last name"  value="{{ $last_name }}">
                    @error('lastname')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input class="form-control" style="font-weight: 700" type="file" id="" name="avatar"/>
                    @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" style="font-weight: 700" type="text" id="email" readonly name="email" placeholder="john.doe@example.com"  value="{{ $user->email }}" />
                    @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-md-12">
                <label for="passord" class="form-label">mật khẩu</label>
                <input class="form-control" style="font-weight: 700" type="password" id="passord" name="password" placeholder="password" disabled value="***********"/>
                @error('password')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label" for="phoneNumber">Số điện thoại</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">US (+84)</span>
                    <input type="text" id="phoneNumber" name="phone" class="form-control" style="font-weight: 700" placeholder="202 555 0111"  value="{{ $user->phone }}"/>
                </div>
                @error('phone')
                <span style="color: red">{{ $message }}</span>
                @enderror
                </div>

                <div class="col-md-12">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" style="font-weight: 700" id="address" name="address" placeholder="Address"  value="{{ $user->address }}"/>
                    @error('address')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                <label class="form-label" for="country">Thành phố</label>
                <select name="city_id" id="city" class="select2 form-control choose city">
                    <option value="">--- Chọn Thành Phố ---</option>
                    @foreach ($city as $item)
                        @if($item->city_id == $user->city_id)
                        <option value="{{ $item->city_id }}" selected>{{ $item->city_name }}</option>
                        @else
                        <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('city_id')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                <label class="form-label" for="province">Tỉnh</label>
                <select name="province_id" id="province" class="select2 form-control choose province">
                    <option value="">--- Chọn Tỉnh ---</option>
                    @foreach ($province as $item)
                        @if($item->province_id == $user->province_id)
                        <option value="{{ $item->province_id }}" selected>{{ $item->province_name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('province_id')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                <label class="form-label" for="ward">Phường xã</label>
                <select name="ward_id" id="ward" class="select2 form-control ward">
                    <option value="">--- Chọn Phường/Xã ---</option>
                    @foreach ($ward as $item)
                        @if($item->ward_id == $user->ward_id)
                        <option value="{{ $item->ward_id }}" selected>{{ $item->ward_name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('ward_id')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                </div>
                <div class="col-md-12">
                    <label></label>
                    <div class="text-center">
                        <button type="submit" class="btn btn-main text-center" >Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
@endsection
