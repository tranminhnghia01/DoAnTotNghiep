@extends('frontend.layouts.app')
@section('content')

@include('frontend.layouts.service')
{{-- <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Dịch vụ</p>
            <h1>Giải pháp của chúng tôi</h1>
        </div>
        <div class="row g-4">
        @foreach ($service as $key=>$value)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('uploads/services/'.$value->service_image) }}" alt="" style="width: 100%; height: 300px">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>{{ $value->service_name }}</h5>
                        @if ($value->service_status == "on")
                            <a href="{{ route('home.'.$value->service_slug) }}" class="text-orange">Chi tiết</a>

                        @else
                        <a title="Dịch vụ đang phát triển" class="text-orange">Chi tiết</a>
                        @endif
                        <div class="team-social text-center">
                            <a class="btn btn-square"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div> --}}
@endsection

