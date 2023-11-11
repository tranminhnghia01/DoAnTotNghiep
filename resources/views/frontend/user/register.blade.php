@extends('frontend.layouts.blocks.app')
@section('content')
@if (session('msg'))
<div class="alert alert-{{session('style')}}">
    {{ session('msg') }}
</div>
@endif
<section class="signin-page account">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="block text-center">
            <a class="logo" href="index.html">
              <img src="images/logo.png" alt="">
            </a>
            <h2 class="text-center">Create Your Account</h2>
            <form class="text-left clearfix" action="{{ route('home.register') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Firt Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First name">
                        @error('firstname')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last name">
                        @error('lastname')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="email" name="avatar"/>
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="john.doe@example.com" />
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="passord" class="form-label">Password</label>
                    <input class="form-control" type="password" id="passord" name="password" placeholder="password" />
                    @error('password')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">US (+84)</span>
                        <input type="text" id="phoneNumber" name="phone" class="form-control" placeholder="202 555 0111"/>
                    </div>
                    @error('phone')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address"/>
                        @error('address')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                    <label class="form-label" for="country">Country</label>
                    <select name="city_id" id="city" class="select2 form-control choose city">
                        <option value="">--- Chọn Thành Phố ---</option>
                        @foreach ($city as $item)
                        <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                    <label class="form-label" for="province">Province</label>
                    <select name="province_id" id="province" class="select2 form-control choose province">
                        <option value="">--- Chọn Tỉnh ---</option>
                        @foreach ($province as $item)
                        @endforeach
                    </select>
                    @error('province_id')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                    <label class="form-label" for="ward">Ward</label>
                    <select name="ward_id" id="ward" class="select2 form-control ward">
                        <option value="">--- Chọn Phường/Xã ---</option>
                        @foreach ($ward as $item)
                        @endforeach
                    </select>
                    @error('ward_id')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-main text-center" >Sign Up</button>
                    </div>

            </form>
            <p class="mt-20">Already hava an account ?<a href="{{ route('home.login') }}"> Login</a></p>
            <p><a href="forget-password.html"> Forgot your password?</a></p>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

