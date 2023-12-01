@include('frontend.layouts.header')
        <!-- 404 Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <i class="bi bi-exclamation-triangle display-1 text-orange"></i>
                        <h1 class="display-1">404</h1>
                        <h1 class="mb-4">Không tìm thấy trang</h1>
                        <p class="mb-4">Chúng tôi rất tiếc,trang bạn tìm kiếm không tồn tại hoặc đang phát triển trên trang web của chúng tôi! Có thể truy cập trang chủ của chúng tôi hoặc thử sử dụng tìm kiếm?</p>
                        <a class="btn btn-orange rounded-pill py-3 px-5" style="border:1px solid #fd7e14" href="{{ route('home.index') }}">Về Trang Chính</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->
        @include('frontend.layouts.footer')

