@extends('frontend.layouts.app')
@section('content')
        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $service->service_name }}</h1>
                <p class="text-white" style="width: 50%;">{{ $service->service_des }}</p>

                <nav aria-label="breadcrumb animated slideInDown" >
                    <ol class="breadcrumb text-uppercase mb-0">
                        <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" href="">Trải nghiệm dịch vụ</a>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex flex-column">
                            <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('frontend/img/about-1.jpg') }}" alt="">
                            <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{ asset('frontend/img/about-2.jpg') }}" alt="" style="margin-top: -25%;">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <p class="d-inline-block border rounded-pill py-1 px-4">Giới thiệu</p>
                        <h1 class="mb-4">Tại sao lại giúp việc nhà theo giờ? Hãy nói cho chúng tôi biết!</h1>
                        <p>{{ $service->service_des }}</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>An toàn</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Chuyên gia</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Tiết kiệm thời gian</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Hỗ trợ</p>
                        @if (Auth::check())
                            <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" href="{{ route('home.giup-viec-ca-co-dinh.create') }}">Đặt lịch</a>
                        @else
                            <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" href="{{ route('home.login') }}">Đặt lịch</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

@endsection
