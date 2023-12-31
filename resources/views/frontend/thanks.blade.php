@include('frontend.layouts.header')

 @include('frontend.layouts.navbar')
 @if (session('msg'))
 <div class="alert alert-{{session('style')}}">
     {{ session('msg') }}
 </div>
 @endif
<a href="{{ route('home.index') }}">
    <div class="container-fluid header bg-orange p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Website Giúp việc nhà theo giờ</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">123</h2>
                            <p class="text-light mb-0">GIúp việc chuyên môn</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">1234</h2>
                            <p class="text-light mb-0">Tổng số khách hàng</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">12345</h2>
                            <p class="text-light mb-0">Dụng cụ gia đình</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('frontend/img/cs1.jpg') }}" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Giúp việc theo giờ</h1>
                        </div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('frontend/img/cs2.png') }}" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Đi chợ</h1>
                        </div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('frontend/img/chon-dich-vu-home-cooking.png') }}" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Nấu ăn</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End --></a>

    <!-- About Start -->
    <!-- About End -->
    <!-- Service Start -->
    <!-- Service End -->



    <!-- Team Start -->
    <!-- Team End -->


    <!-- Testimonial Start -->
    <!-- Testimonial End -->

@include('frontend.layouts.footer')
