@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Dịch vụ</p>
            <h1>Giải pháp của chúng tôi</h1>
        </div>
        @foreach ($service as $key=>$value)
        <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc">
            <div class="col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded w-100" style="min-height: 150xp" src="{{ asset('uploads/services/'.$value->service_image) }}" alt="">
                </div>
            </div>
            <div class="col-lg-9 wow fadeIn" data-wow-delay="0.5s">
                <h2 class="mb-4">{{ $value->service_name }}</h2>
                <p class="role-4">{{ $value->service_content }}
                </p>
                @if ($value->service_status == "on")
                    <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" href="{{ route('home.'.$value->service_slug) }}">Chi tiết</a>
                @else
                    <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" title="Dịch vụ đang phát triển">Chi tiết</a>
                @endif
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection

