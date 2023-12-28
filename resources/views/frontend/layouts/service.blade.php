<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Dịch vụ</p>
            <h1>Giải pháp giúp việc nhà</h1>
        </div>
        <div class="row g-4">
            @foreach ($service as $key => $val)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 100%; height: 100px;">
                            <img src="{{asset('uploads/services/'.$val->service_image) }}" alt="" style="width: 100%;height: 100px;">
                        </div>
                        <h4 class="mb-3">{{ $val->service_name }}</h4>
                        <p class="mb-4 role-4">{{ $val->service_des }}</p>
                        <a class="btn" href="{{ route('home.service.show',$val->service_id) }}"><i class="fa fa-plus text-orange me-3"></i>Đọc thêm</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
