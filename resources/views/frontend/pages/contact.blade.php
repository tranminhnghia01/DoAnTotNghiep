@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Liên hệ chúng tôi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item text-orange active" aria-current="page">Liên hệ</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-map-marker-alt text-orange"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Địa chỉ</p>
                            <h5 class="mb-0">{{ $infomation->info_address }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-orange"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Gọi ngay cho chúng tôi</p>
                            <h5 class="mb-0">+{{ $infomation->info_phone }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-orange"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Gửi thư cho chúng tôi</p>
                            <h5 class="mb-0">{{ $infomation->info_email }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                    <div class="bg-light rounded p-5">
                        <p class="d-inline-block border rounded-pill py-1 px-4">Liên hệ với chúng tôi</p>
                        <h1 class="mb-4">Bạn có bất kỳ câu hỏi nào? Vui lòng gửi cho chúng tôi!</h1>
                        <p class="mb-4">Biểu mẫu liên hệ hiện không hoạt động. Nhận biểu mẫu liên hệ hoạt động hiệu quả với Ajax & PHP trong vài phút. Chỉ cần sao chép và dán các tập tin, thêm một chút mã và bạn đã hoàn tất<P>
                        <form action="" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="contact_name" placeholder="Tên của bạn">
                                        <label for="name">Tên của bạn</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="contact_email" placeholder="Email của bạn">
                                        <label for="email">Email của bạn</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="contact_subject" placeholder="Vấn đề">
                                        <label for="subject">Vấn đề về</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" name="contact_content" style="height: 100px"></textarea>
                                        <label for="message">Nội dung</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">

                    <div class="bg-light rounded p-5">
                        <div class="row">
                        <p class="mb-4">Fanpage của chúng tôi</p>
                            {!! $infomation->info_fanpage !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100" style="min-height: 800px;">
                        <p class="mb-4">Bản đồ</p>

                        {!! $infomation->info_map !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
