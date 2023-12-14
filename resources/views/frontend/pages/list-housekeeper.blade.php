@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        @foreach ($housekeeper as $key=>$value)
        <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc">
            <div class="col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded w-100" src="{{ asset('uploads/users/'.$value->image) }}" alt="">
                </div>
            </div>
            <div class="col-lg-9 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4">{{ $value->name }}</h1>
                <p class="role-4">{{ $value->des }}
                </p>

                <p><i class="far fa-check-circle text-orange me-3"></i>Số điện thoại: {{ $value->phone }}</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>Tuổi: {{ $value->age }}</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>Địa chỉ liên hệ: {{ $value->address }}</p>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection

