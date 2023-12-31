@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Đặt lịch</p>
                <h1 class="mb-4">{{ $service->service_name }}</h1>
                <h1 class="mb-4"><img src="{{ asset('uploads/services/'.$service->service_image) }}" alt="" style="width:100%;min-height:250px"></h1>

                <p class="mb-4">{{ $service->service_des }}</p>
                <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-phone-alt text-orange"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Số điện thoại</p>
                        <h5 class="mb-0">{{ $shipping->shipping_phone }}</h5>
                    </div>
                </div>
                <div class="bg-light rounded d-flex align-items-center p-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-envelope-open text-orange"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Địa chỉ của tôi</p>
                        <h5 class="mb-0">{{ $shipping->shipping_address }}  <span><a href="{{ route('home.checkout') }}" title="Thay đổi"><i class="fas fa-map-marked-alt"></i></a></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s" style="color: #000">
                <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                    @yield('form-service')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
