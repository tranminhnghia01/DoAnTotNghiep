@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        @foreach ($service as $key=>$value)
        <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc">
            <div class="col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded w-100" src="{{ asset('uploads/services/'.$value->service_image) }}" alt="">
                </div>
            </div>
            <div class="col-lg-9 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4">{{ $value->service_name }}</h1>
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

