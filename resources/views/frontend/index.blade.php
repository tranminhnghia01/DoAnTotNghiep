@include('frontend.layouts.header')

 @include('frontend.layouts.navbar')
 @if (session('msg'))
 <div class="alert alert-{{session('style')}}">
     {{ session('msg') }}
 </div>
 @endif
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<div class="container">
    <h3>Bootstrap Multi Select Date Picker</h3>
    <input type="text" class="form-control date" placeholder="Pick the multiple dates">
</div>
<script>
    $('.date').datepicker({
    multidate: true,
    format: 'dd-mm-yyyy',
    min
});
</script> --}}
    <!-- Header Start -->
    <div class="container-fluid header bg-orange p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Website Giúp việc nhà theo giờ</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $Count_house }}</h2>
                            <p class="text-light mb-0">GIúp việc chuyên môn</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $Count_user }}</h2>
                            <p class="text-light mb-0">Tổng số khách hàng</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $Count_service }}</h2>
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
    <!-- Header End -->

    <!-- About Start -->
    @include('frontend.layouts.about')
    <!-- About End -->
    <!-- Service Start -->
    @include('frontend.layouts.service')
    <!-- Service End -->



    <!-- Team Start -->
    @include('frontend.layouts.team')
    <!-- Team End -->


    <!-- Testimonial Start -->
    @include('frontend.layouts.testimonial')
    <!-- Testimonial End -->

@include('frontend.layouts.footer')
