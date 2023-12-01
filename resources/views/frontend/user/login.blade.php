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
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="max-width: 50%; padding-bottom: 3rem;">
                    <div class="rounded p-5" style="background-color: #fff;">
                        <p class="d-inline-block border rounded-pill py-1 px-4">Đăng nhập</p>
                        <h1 class="mb-4">Đăng nhập tài khoản</h1>
                        <form method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <label for="password">Mật khẩu</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Đăng nhập</button>
                                </div>

                            </div>
                        </form>
                        <p class="mt-20" style="margin-top: 16px;">Bạn chưa có tài khoản ?<a href="{{ route('home.register') }}">Tạo tài khoản</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 50%;">
        <div class="bg-light rounded p-5">
            <p class="d-inline-block border rounded-pill py-1 px-4">Đăng nhập</p>
            <h1 class="mb-4">Đăng nhập tài khoản</h1>

            <form method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-floating">
                             <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Mật khẩu</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Đăng nhập</button>
                    </div>

                </div>
            </form>
            <p class="mt-20" style="margin-top: 16px;">Bạn chưa có tài khoản ?<a href="{{ route('home.register') }}">Tạo tài khoản</a></p>
        </div>
    </div> --}}

{{--
    <section class="signin-page account">
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <div class="block text-center">
                <a class="logo" href="index.html">
                <img src="images/logo.png" alt="">
                </a>
                <h2 class="text-center">Welcome Back</h2>
                <form class="text-left clearfix" action="" method="POST" >
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-main text-center" >Login</button>
                    </div>
                </form>
                <p class="mt-20">New in this site ?<a href="{{ route('home.register') }}"> Create New Account</a></p>
            </div>
            </div>
        </div>
        </div>
    </section> --}}
@endsection
{{-- @include('frontend.layouts.footer') --}}
